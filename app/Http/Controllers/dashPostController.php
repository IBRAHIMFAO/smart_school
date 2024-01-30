<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Matiere;
use App\Models\User;
use App\Models\Post;
use App\Models\PostGroup;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;



class dashPostController extends Controller
{
    // public function createPost(Request $request)
    // {
    //     // Check the user's role
    //     $userRole = auth()->user()->role;

    //     // Check if the user is a "prof," "directeur," or "surveillant"
    //     if ($userRole === 'prof' || $userRole === 'directeur' || $userRole === 'surveillant') {
    //         // Create a new post
    //         $post = new Post();
    //         $post->content = $request->input('content');
    //         $post->type = $request->input('type'); // You can modify this as needed
    //         $post->code_user = auth()->id();

    //         // Additional logic for sharing with specific groups or all groups

    //         $post->save();

    //         return response()->json(['success' => true, 'message' => 'Post created successfully']);
    //     }

    //     return response()->json(['success' => false, 'message' => 'You do not have permission to create a post']);
    // }

    public function create()
    {
        $groups = Group::all(); // Get the list of groups
        $matieres = Matiere::all(); // Get the list of matieres

        return view('postes-dash.create', ['groups' => $groups, 'matieres' => $matieres]);
    }


        // public function store(Request $request)
        // {
        //     $request->validate([
        //         'type' => 'required',
        //         'content' => 'required_if:type,text',
        //         'file_path' => 'required_if:type,file|mimes:pdf,doc,docx,xls,xlsx',
        //         'image_paths' => 'required_if:type,image',
        //         'link' => 'required_if:type,link|url',
        //         'code_group' => 'required|array',
        //         'code_matiere' => 'nullable|exists:matieres,id',
        //     ]);

        //     // Handle file upload (if any)
        //     $filePaths = [];
        //     if ($request->hasFile('file_path')) {
        //         $filePaths[] = $request->file('file_path')->store('files');
        //     }

        //     // Handle image upload (if any)
        //     $imagePaths = [];
        //     if ($request->hasFile('image_paths')) {
        //         foreach ($request->file('image_paths') as $image) {
        //             $imagePaths[] = $image->store('images');
        //         }
        //     }

        //     $post = new Post([
        //         'type' => $request->input('type'),
        //         'content' => $request->input('content'),
        //         'file_path' => count($filePaths) > 0 ? $filePaths[0] : null,
        //         'image_paths' => count($imagePaths) > 0 ? json_encode($imagePaths) : null,
        //         'link' => $request->input('link'),
        //     ]);

        //     // Associate the post with selected groups and matiere
        //     $post->user()->associate(auth()->user());
        //     $post->groups()->sync($request->input('code_group'));
        //     $post->matiere()->associate($request->input('code_matiere'));

        //     $post->save();

        //     return redirect()->route('post.index')->with('success', 'Le post a été créé avec succès.');
        // }



    public function store(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required',
                'content' => 'required_if:type,text',
                'file_path' => 'nullable | required_if:type,file|mimes:pdf,doc,docx,xls,xlsx',
                'image_path' => 'nullable | image | mimes:jpeg,png,jpg,gif,svg | max:4048 ',
                'link' => 'nullable |required_if:type,link|url',
                'code_group' => 'required|array',
                'code_matiere' => 'nullable|exists:matieres,id',
            ]);
                
            // Log the request data
            Log::info('Request data:', $request->all());


            // Handle image upload (if any)
            // $imagePaths = [];
            // if ($request->hasFile('image_paths')) {
            //     foreach ($request->file('image_paths') as $image) {
            //         // $imagePaths[] = $image->store('images/images_post','public');
            //         $imagePaths[] = $image->store('images/post_images','public');

            //     }
            // }

            // Create a new post
            $post = new Post([
                'type' => $request->input('type'),
                'content' => $request->input('content'),
                // 'file_path' => count($filePaths) > 0 ? $filePaths[0] : null,
                // 'image_paths' => count($imagePaths) > 0 ? json_encode($imagePaths) : null,

                'link' => $request->input('link'),
            ]);

            // Handle image upload for the post
            if ($request->hasFile('image_path')) {
                // $imagePath = $request->file('image_path')->store('images/post_images', 'public');
                $imagePath = $request->file('image_path')->store('images/post_images', 'public');
                $post->image_path = $imagePath;
                
            }

             // Handle file upload (if any)
             if ($request->hasFile('file_path')) {
                $filePaths = $request->file('file_path')->store('files/post_files', 'public');
                $post->file_path = $filePaths;
            }


            // Associate the post with the user
            $post->user()->associate(auth()->user());
            $post->save();

            // Handle the many-to-many relationship with groups
            foreach ($request->input('code_group') as $groupCode) {
                $postGroup = new PostGroup([
                    'code_post' => $post->id,
                    'code_group' => $groupCode,
                ]);
                $postGroup->save();
            }


            // Associate the post with matiere
            $post->matiere()->associate($request->input('code_matiere'));

            return redirect()->route('post.index')->with('success', 'Le post a été créé avec succès.');
        // } catch (ValidationException $e) {
            
        //     return redirect()->route('post.create')->withErrors($e->errors())->withInput();
        // } catch (\Exception $e) {
        //     Log::error($e);
        //     return redirect()->route('post.create')->with('error', 'Une erreur s\'est produite lors de la création du post.')->withInput();
        // }
        } catch (\Exception $e) {
            Log::error($e);
            // dd($e);
            return redirect()->route('post.create')->with('error', 'An error occurred while creating the post.')->withInput();
        }
    
    }







        public function index(){
            $posts = Post::with('user', 'comments')->get();

            return view('postes-dash.index', ['posts' => $posts]);
            
        }


        public function edit($id)
    {
        $post = Post::findOrFail($id);
        $groups = Group::all();
        $matieres = Matiere::all();
        $selectedGroups = $post->groups->pluck('id')->toArray();

        return view('postes-dash.edit', compact('post', 'groups', 'matieres', 'selectedGroups'));
    }
    
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Validation rules (customize based on your requirements)
        $rules = [
            'type' => 'required',
            'content' => 'required_if:type,text',
            'file_path' => 'nullable | required_if:type,file|mimes:pdf,doc,docx,xls,xlsx',
            'image_path' => 'nullable | image | mimes:jpeg,png,jpg,gif,svg | max:4048 ',
            'link' => 'nullable |required_if:type,link|url',
            'code_group' => 'required|array',
            'code_matiere' => 'nullable|exists:matieres,id',
        ];

        $request->validate($rules);

        // Update post data
        $post->type = $request->input('type');
        $post->content = $request->input('content');
        $post->link = $request->input('link');
        $post->save();

        // Handle image upload for the post
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images/post_images', 'public');
            $post->image_path = $imagePath;
            $post->save();
        }

        // Handle file upload (if any)
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('files/post_files', 'public');
            $post->file_path = $filePath;
            $post->save();
        }

        // Sync groups
        $post->groups()->sync($request->input('code_group'));

        // Associate the post with matiere
        $post->matiere()->associate($request->input('code_matiere'));
         
        // dd($request->all());

        $post->save();


        return redirect()->route('post.index')->with('success', 'Le post a été modifié avec succès.');
    }

     
     
        public function destroy($id)
        {
            try {
                // Find the post by ID
                $post = Post::findOrFail($id);
        
                // Check if the authenticated user has permission to delete the post (add your own logic if needed)
        
                // Delete the post
                $post->delete();
        
                return redirect()->route('post.index')->with('success', 'Le post a été supprimé avec succès.');
            } catch (\Exception $e) {
                // Log::error($e);
                return redirect()->route('post.index')->with('error', 'Une erreur s\'est produite lors de la suppression du post.');
            }
        }
    


}
