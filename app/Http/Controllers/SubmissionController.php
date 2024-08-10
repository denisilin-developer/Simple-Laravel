<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Jobs\SaveSubmission;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController extends Controller
{
    function store(SubmissionRequest $request): JsonResponse
    {
        try {
            SaveSubmission::dispatch($request->validated());

            return response()->json([
                'message' => __('submission.submission_processed')
            ], Response::HTTP_ACCEPTED);

        } catch (Exception $e) {
            return response()->json([
                'error' => __("submission.submission_error"),
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
