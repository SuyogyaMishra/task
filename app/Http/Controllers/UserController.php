<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\userDocument;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');

        $users = User::with('documents')
            ->orderBy($sort, $order)
            ->paginate(10)
            ->appends(['sort' => $sort, 'order' => $order]); // keep state for pagination

        return view('index', compact('users', 'sort', 'order'));
    }
    public function saveUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|string|max:20',
                'profile_pic' => 'required|image|max:2048',
                'resume' => 'required|mimes:pdf,doc,docx|max:5120',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? null,
            ]);

            if ($request->hasFile('profile_pic')) {
                $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
                userDocument::create([
                    'user_id' => $user->id,
                    'file_path' => $profilePicPath,
                    'file_name' => $request->file('profile_pic')->getClientOriginalName(),
                    'file_type' => 'profile_pic',
                ]);
            }

            if ($request->hasFile('resume')) {
                $resumePath = $request->file('resume')->store('resumes', 'public');
                userDocument::create([
                    'user_id' => $user->id,
                    'file_path' => $resumePath,
                    'file_name' => $request->file('resume')->getClientOriginalName(),
                    'file_type' => 'resume',
                ]);
            }

            return redirect()->to('/')->with(['message' => 'User created successfully']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function fetchData()
    {
        $users = User::with('documents')->orderBy('id', 'desc')
            ->paginate(10);
        return view('index', compact('users'));
    }
    public function search(Request $request)
    {
        $searchTerm = trim($request->input('search'));
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');
        $users = User::where("name", 'like', "%{$searchTerm}%")->orWhere("email", 'like', "%{$searchTerm}%")->with('documents')->orderBy('id', 'desc')
            ->orderBy($sort, $order)
            ->paginate(10)
            ->appends(['sort' => $sort, 'order' => $order]); 
        return view('index', compact('users', 'sort', 'order'));
    }
    public function exportCsv()
    {
        $fileName = 'users_' . date('Y-m-d_H-i-s') . '.csv';
        $filePath = storage_path("app/public/{$fileName}");

        $users = User::with('documents')->get();
        $file = fopen($filePath, 'w');
        fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Profile Pic', 'Resume', 'Created At']);
        foreach ($users as $user) {
            $profilePic = $user->documents->where('file_type', 'profile_pic')->first()->file_path ?? '';
            $resume = $user->documents->where('file_type', 'resume')->first()->file_path ?? '';

            fputcsv($file, [$user->id, $user->name, $user->email, $user->phone, $profilePic, $resume, $user->created_at]);
        }
        fclose($file);

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function exportPdf()
    {
        $users = User::with('documents')->get();

        $pdf = Pdf::loadView('userspdf', compact('users'))
            ->setPaper('a4', 'landscape');

        $fileName = 'users_' . date('Y-m-d_H-i-s') . '.pdf';
        return $pdf->download($fileName);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');
        $users = User::with('documents')->orderBy('id', 'desc')
            ->paginate(10)->appends(['sort' => $sort, 'order' => $order]); // keep state for pagination
        ;
        $editUser = User::with('documents')->find($id);
        return view('index', compact('editUser', 'users','sort', 'order'));
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return back()->with('message', 'User deleted successfully.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        $id = $request->id;

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required|string|max:20',
            ]);

            $user = User::findOrFail($id);

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
            ]);
            if ($request->hasFile('profile_pic')) {
                $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');

                userDocument::updateOrCreate(
                    ['user_id' => $id, 'file_type' => 'profile_pic'],
                    [
                        'file_path' => $profilePicPath,
                        'file_name' => $request->file('profile_pic')->getClientOriginalName(),
                    ]
                );
            }

            if ($request->hasFile('resume')) {
                $resumePath = $request->file('resume')->store('resumes', 'public');

                userDocument::updateOrCreate(
                    ['user_id' => $id, 'file_type' => 'resume'],
                    [
                        'file_path' => $resumePath,
                        'file_name' => $request->file('resume')->getClientOriginalName(),
                    ]
                );
            }

            return redirect()->route('index')->with('message', 'User updated successfully.');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
