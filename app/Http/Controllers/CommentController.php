<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Subscription;
use App\Models\Package;

class CommentController extends Controller
{
    // Index
    public function index(Request $request){
        $subscription = Subscription::where(["user_id" => session()->get('user')->id, "plan" => 3])->first();
        
        if(empty($subscription) && $request->session()->get('user')->id != 1){
            return view("subscription.index", ["packages" => Package::all()]);
        }
        
        if($request->session()->get("user")->role_id == 1){
            return view("commentingSystem.comments_view", [
                "comments" => Comment::leftJoin("users", "comments.user_id", "=", "users.id")
                ->join("colors", "comments.status", "=", "colors.id")
                ->select(
                    "comments.*",
                    "users.first_name",
                    "users.last_name",
                    "colors.id as color_id",
                    "colors.status_name",
                    "colors.status_color"
                )->get()
            ]);
        }else{
            return view("commentingSystem.comments_view", [
                "comments" => Comment::where("user_id", $request->session()->get("user")->id)
                ->join("users", "comments.user_id", "=", "users.id")
                ->join("colors", "comments.status", "=", "colors.id")
                
                ->select(
                    "comments.*",
                    "users.first_name",
                    "users.last_name",
                    "colors.id as color_id",
                    "colors.status_name",
                    "colors.status_color"
                )->get(),
            ]);
        }
    }

    // Create comment view
    public function commentView(){
        return view("commentingSystem.comment");
    }
    
    // Create comment
    public function create(Request $request){
        
        $request->validate([
            "platform" => "required",
            "url" => "required|url",
        ]);

        $comment = Comment::create([
            "platform" => $request->platform,
            "comment_type" => $request->comment_type,
            "url" => $request->url,
            "actual_comment" => $request->actual_comment,
            "feedback" => $request->feedback,
            "user_id" => session()->get("user")->id,
        ]);   
        
        if($comment){
            return redirect("/comments_view")->with("comment_success", $request->comment_type." sent");
        }else{
            return back()->with("comment_error", "Failed to send ".$request->comment_type);
        }
    }


    // Update comment
    public function update(Request $request){
        $comment = Comment::find($request->id);
        $comment->actual_comment = $request->actual_comment;
        $comment->feedback = $request->feedback;
        $comment->comment_type = $request->comment_type;
        if($comment->update()){
            return back()->with("comment_info", $request->comment_type." updated");
        }else{
            return back()->with("comment_info", "Failed to update ".$request->comment_type);
        }
    }


    // Get comment
    public function getComment(Request $request){
        // return Comment::find($request->comment_id);
        $comment = Comment::leftJoin("users", "comments.user_id", "=", "users.id")
        ->join("colors", "comments.status", "=", "colors.id")
        ->where("comments.id", $request->comment_id)
        ->select(
            "comments.*",
            "users.first_name",
            "users.last_name",
            "colors.id as color_id",
            "colors.status_name",
            "colors.status_color",
        )
        ->first();
        return response()->json($comment);
    }

    // Reject
    public function reject($id){
        $comment = Comment::find($id);
        $comment->status = 5;
        if($comment->update()){
            return back()->with("comment_error", "Comment rejected");
        }else{
            return back()->with("comment_error", "Failed to reject comment");
        }
    }

    // Approve
    public function approve(Request $request){
        $comment = Comment::find($request->comment_id);
        $comment->feedback = $request->feedback;
        $comment->status = 3;
        if($comment->update()){
            return back()->with("comment_info", "Comment approved");
        }else{
            return back()->with("comment_error", "Failed to approve comment");
        }
    }

    public function delete(Request $request){
        $comment = Comment::find($request->id);
        $comment_name = $comment->comment_type;
        if($comment->delete()){
            return back()->with("comment_error", $comment_name." deleted");
        }else{
            return back()->with("comment_error", "Failed to delete ".$comment_name);
        }
    }
}
