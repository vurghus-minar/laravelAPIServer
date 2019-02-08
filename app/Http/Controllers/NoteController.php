<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Note;
use App\Http\Resources\Note as NoteResource;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Notes
        try {
            $notes = Note::paginate(15);
        } catch(\Exception $e){
            return response()->json('There was an error processing your request', 500);
        }
        
        // Return collection of articles as a resource
        return NoteResource::collection($notes);
    }

    /**
     * Display user's notes
     * 
     * @return \Illuminate\Http\Response
     */
    public function showUserNotes()
    {
        // Get User notes
        try {
            $notes = Note::where('user_id', auth()->user()->id)->paginate(15);
        } catch(\Exception $e){
            return response()->json('There was an error processing your request', 500);
        }
        
        return NoteResource::collection($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'theme' => 'required'
        ]);
        
        try {
            $note = new Note;
            $note->user_id = auth()->user()->id;
            $note->title = $request->input('title');
            $note->body = $request->input('body');
            $note->theme = $request->input('theme');

            if ($note->save()) {
                return new NoteResource($note);
            }
            
        } catch (\Exception $e) {

            return response()->json('There was an error processing your request', 500);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $note = Note::findorfail($request->input('id'));
        } catch(\Exception $e){
            return response()->json('There was an error processing your request', 500);
        }

        if ($note->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized', 401);
        }

        $note->id = $request->input('id');
        $note->title = $request->input('title');
        $note->body = $request->input('body');
        $note->theme = $request->input('theme');

        try {

            $note->save();
            return response()->json('Note successfully updated', 200);            

        } catch (\Exception $e) {
            return response()->json('There was an error processing your request', 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $note = Note::findorfail($id);
        } catch(\Exception $e){
            return response()->json('There was an error processing your request', 500);
        };

        // Return note as a resource
        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $note = Note::findorfail($id);
        } catch(\Exception $e){
            return response()->json('There was an error processing your request', 500);
        }

        if ($note->user_id !== auth()->user()->id) {
            return response()->json('Unauthorized action', 401);
        }

        try {
            $note->delete();
            return response()->json('Deleted note successfully', 200);
        } catch (\Exception $e) {
             return response()->json('There was an error processing your request', 500);
        }

    }
}
