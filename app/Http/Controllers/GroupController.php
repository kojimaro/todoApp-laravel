<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupRepository;

class GroupController extends Controller
{
    /**
     * @var GroupRepository
     */
    protected $groups;

    /**
     * @return void
     */
    public function __construct(GroupRepository $groups)
    {
        $this->middleware('auth');
        $this->groups = $groups;
    }

    public function index(Request $request) {
        $groups = $this->groups->forOwner($request->user());

        return view('/groups.index', ['groups' => $groups]);
    }

    /**
     * 新しいグループの作成
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $request->user()->groups()->create([
            'name' => $request->name
        ]);

        return redirect('/groups');
    }
}