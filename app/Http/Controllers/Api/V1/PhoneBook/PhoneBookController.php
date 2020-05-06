<?php

namespace App\Http\Controllers\Api\V1\PhoneBook;

use App\Http\Controllers\Controller;
use App\PhoneBook;
use App\Http\Resources\PhoneBook\PhoneBookCollection as PhoneBookCollectionResource;
use App\Http\Resources\PhoneBook\PhoneBook as PhoneBookResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PhoneBook as PhoneBookRequest;

class PhoneBookController extends Controller
{
    /**
     * Display a listing of the phone books.
     *
     * @param Request $request
     * @return PhoneBookCollectionResource
     */
    public function index(Request $request): PhoneBookCollectionResource
    {
        return new PhoneBookCollectionResource($request->user()->phoneBooks);
    }

    /**
     * Show the fields for creating a new phone book item.
     *
     * @param Request $request
     */
    public function create(Request $request): JsonResponse
    {
        return response()->json([
            'data' => [
                'name' => "Required and min length 3 and max length 255",
                'telephone' => "Optional and min length 11 abd max length 30",
                'mobile' => "Optional and min length 11 abd max length 30",
            ]
        ], 200);
    }

    /**
     * Store a newly created phone book item in storage.
     *
     * @param PhoneBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PhoneBookRequest $request): JsonResponse
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $phoneBook = new PhoneBook();
        $phoneBook->fill($data)
            ->save();

        return response()->json([
            'data' => [
              'id' => $phoneBook->id
            ],
        ], 200);
    }

    /**
     * Display the specified phone book item.
     *
     * @param PhoneBook $phoneBook
     * @return PhoneBookResource
     */
    public function show(PhoneBook $phoneBook): PhoneBookResource
    {
        return new PhoneBookResource($phoneBook);
    }

    /**
     * Show the form for editing the specified phone book item.
     *
     * @param PhoneBook $phoneBook
     * @return PhoneBookResource
     */
    public function edit(PhoneBook $phoneBook): PhoneBookResource
    {
        return new PhoneBookResource($phoneBook);
    }

    /**
     * Update the specified phone book item in storage.
     *
     * @param PhoneBookRequest $request
     * @param PhoneBook $phoneBook
     * @return PhoneBookResource
     */
    public function update(PhoneBookRequest $request, PhoneBook $phoneBook): PhoneBookResource
    {
        $phoneBook->update($request->all());
        return new PhoneBookResource($phoneBook);
    }

    /**
     * Remove the specified phone book item from storage.
     *
     * @param PhoneBook $phoneBook
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(PhoneBook $phoneBook): JsonResponse
    {
        $phoneBook->delete();
        return response()->json([], 204);
    }
}
