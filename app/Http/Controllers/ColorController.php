<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Color;

class ColorController extends Controller
{
    public function setColors(Request $request){
        $color_created = null;
        
        if(Color::all()->count() == 0){
            
            // Pending
            $color_created = Color::create([
                "status_name" => "pending",
                "status_color" => $request->pending_color

            ]);

            // In progress
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "in_progress",
                    "status_color" => $request->in_progress_color
    
                ]);
                
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for pending");
            }

            // Approve
            if($color_created){
                
                $color_created = Color::create([
                    "status_name" => "approve",
                    "status_color" => $request->approve_color

                ]);
                
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for process");
            }


            // Complete
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "complete",
                    "status_color" => $request->complete_color
    
                ]);
                
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for approve");
            }

            // Rejected
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "reject",
                    "status_color" => $request->reject_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // Assigned
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "assigned",
                    "status_color" => $request->assigned_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // Waiting for edit approval
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "waiting for edit approval",
                    "status_color" => $request->waiting_for_edit_approval_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // Waiting for client approval
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "waiting for client's approval",
                    "status_color" => $request->waiting_for_client_approval_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // Can't Use
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "can't use",
                    "status_color" => $request->cant_use_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // Posted
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "posted",
                    "status_color" => $request->posted_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // Sent to client to post
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "sent to client to post",
                    "status_color" => $request->sent_to_client_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // caption waiting for approval
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "sent to client to post",
                    "status_color" => $request->caption_waiting_for_approval_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // revise caption
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "sent to client to post",
                    "status_color" => $request->revise_caption_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }
            
            // caption approved
            if($color_created){
                $color_created = Color::create([
                    "status_name" => "sent to client to post",
                    "status_color" => $request->caption_approved_color
    
                ]);
            }else{
                return redirect()->route("settings")->with("colors", "Failed set color for compelet");
            }


            if($color_created){
                return redirect()->route("settings")->with("colors", "Colors created successfully");
            }else{
                return redirect()->route("settings")->with("colors", "Failed to set color for Reject");
            }
        }
        
        foreach(Color::all() as $color){
            if($color->id == 1){
                if($request->pending_color != null){
                    $color->status_color = $request->pending_color;
                }
            }

            if($color->id == 2){
                if($request->in_progress_color != null){
                    $color->status_color = $request->in_progress_color;
                }
                
            }

            if($color->id == 3){
                if($request->approve_color != null){
                    $color->status_color = $request->approve_color;
                }
                
            }

            if($color->id == 4){
                if($request->complete_color != null){
                    $color->status_color = $request->complete_color;
                }
                
            }

            if($color->id == 5){
                if($request->reject_color != null){
                    $color->status_color = $request->reject_color;
                }
            }
            
            if($color->id == 6){
                if($request->assigned_color != null){
                    $color->status_color = $request->assigned_color;
                }
            }
            
            if($color->id == 7){
                if($request->waiting_for_edit_approval_color != null){
                    $color->status_color = $request->waiting_for_edit_approval_color;
                }
            }
            
            if($color->id == 8){
                if($request->waiting_for_client_approval_color != null){
                    $color->status_color = $request->waiting_for_client_approval_color;
                }
            }
            
            if($color->id == 9){
                if($request->cant_use_color != null){
                    $color->status_color = $request->cant_use_color;
                }
            }
            
            if($color->id == 10){
                if($request->posted_color != null){
                    $color->status_color = $request->posted_color;
                }
            }
            
            if($color->id == 11){
                if($request->sent_to_client_color != null){
                    $color->status_color = $request->sent_to_client_color;
                }
            }
            
            if($color->id == 12){
                if($request->caption_waiting_for_approval_color != null){
                    $color->status_color = $request->caption_waiting_for_approval_color;
                }
            }
            
            if($color->id == 13){
                if($request->revise_caption_color != null){
                    $color->status_color = $request->revise_caption_color;
                }
            }
            
            if($color->id == 14){
                if($request->caption_approved_color != null){
                    $color->status_color = $request->caption_approved_color;
                }
            }
            
            
            $color->update();
        }

        return redirect()->route("settings")->with("colors", "Colors updated");
    }
}
