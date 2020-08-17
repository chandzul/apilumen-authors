<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
  use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * [index description]
     *
     * @return  [type]  [return description]
     */
    public function index() 
    {
      $authors = Author::all();

      return $this->successResponse($authors);
    }

    /**
     * [store description]
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [type]             [return description]
     */
    public function store(Request $request)
    {
      $rules = [
        'name' => 'required|max:255',
        'gender' => 'required|max:255|in:male,female',
        'country' => 'required|max:255',
      ];

      $this->validate($request, $rules);

      $author = Author::create($request->all());

      return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * [show description]
     *
     * @param   [type]  $author  [$author description]
     *
     * @return  [type]           [return description]
     */
    public function show($author)
    {
      $author = Author::findOrFail($author);

      return $this->successResponse($author);
    }

    /**
     * [update description]
     *
     * @param   Request  $request  [$request description]
     * @param   [type]   $author   [$author description]
     *
     * @return  [type]             [return description]
     */
    public function update(Request $request, $author)
    {
      $rules = [
        'name' => 'max:255',
        'gender' => 'max:255|in:male,female',
        'country' => 'max:255',
      ];

      $this->validate($request, $rules);

      $author = Author::findOrFail($author);

      $author->fill($request->all());

      if($author->isClean()) {
        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
      }

      $author->save();

      return $this->successResponse($author);   
    }

    /**
     * [destroy a exist author]
     *
     * @param   [type]  $author  [$author description]
     *
     * @return  [type]           [return description]
     */
    public function destroy($author)
    {
      $author = Author::findOrFail($author);

      $author->delete();

      return $this->successResponse($author);
    }
}
