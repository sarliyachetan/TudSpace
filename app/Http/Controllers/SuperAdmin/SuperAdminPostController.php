<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class SuperAdminPostController extends Controller
{
    public function index()
    {
        $Post = Post::orderBy('id', 'asc')->paginate(10);
        return view('superadmin.post.index',compact('Post'));
    }
    public function filter(Request $request)
    {
        $query = $request->input('query');
        $Post = Post::select('title', 'content')
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%");
            })
            ->orderBy('id', 'asc')
            ->get();

        return response()->json(['Post' => $Post]);
    }
    public function store(Request $request)
    {
          $Post = new Post();
          $Post->title = $request->title;
          $Post->content = $request->content;
          $Post->status = 'draft';
          $Post->save();
          return response()->json(['status' => true, 'message' => 'Posts Created Request Successfully']);
    }
     public function edit($id)
    { 
        $Post = Post::findOrFail($id);
        if (!$Post) {
            return response()->json(['status' => false, 'message' => 'Post not found']);
        }
        return response()->json([
            'status' => true,
            'message' => [
                'id' => $Post->id,
                'title' => $Post->title,
                'content' => $Post->content,

               
            ]
        ]);
    }
    public function update(Request $request, $id)
    {
        $Post = Post::findOrFail($id);
        $Post->title = $request->input('title');
        $Post->content = $request->input('content');
        $Post->status = $request->input('status');
        $Post->save();
        return response()->json(['status' => true, 'message' => 'Post Updated Successfully']);
    }
    public function delete($id)
    {
        $Post = Post::find($id);
        if (!$Post) {
            return response()->json(["success" => false, "message" => "Post not found"], 404);
        }
        $Post->delete();
        return response()->json(["success" => true, "message" => "Post Record Successfully Deleted"], 200);
    }
    public function toggleStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:post,id',
            'status' => 'required|in:draft,published',
        ]);

        $post = Post::findOrFail($request->id);
        $post->status = $request->status;
        $post->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }
}



