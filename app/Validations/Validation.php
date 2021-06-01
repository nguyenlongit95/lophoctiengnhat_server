<?php

namespace App\Validations;

class Validation
{
    /**
     * Function validate course level source
     *
     * @param $request
     */
    public static function validateCourseLevelSource($request)
    {
        $request->validate([
            'source' => 'required',
            'drought' => 'required',
            'chinese' => 'required',
            'meaning' => 'required',
        ], [
            'source.required' => config('langVN.validation.course_level_source.source_required'),
            'drought.required' => config('langVN.validation.course_level_source.drought_required'),
            'chinese.required' => config('langVN.validation.course_level_source.chinese_required'),
            'meaning.required' => config('langVN.validation.course_level_source.meaning_required'),
        ]);
    }

    /**
     * Function validate course level quiz
     *
     * @param $request
     */
    public static function validateCourseLevelQuiz($request)
    {
        $request->validate([
            'quiz' => 'required|min:3',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'correct_answer' => 'required',
        ], [
            'quiz.required' => config('langVN.validation.course_level_quiz.quiz_required'),
            'quiz.min' => config('langVN.validation.course_level_quiz.quiz_min'),
            'answer1.required' => config('langVN.validation.course_level_quiz.answer1_required'),
            'answer2.required' => config('langVN.validation.course_level_quiz.answer2_required'),
            'answer3.required' => config('langVN.validation.course_level_quiz.answer3_required'),
            'answer4.required' => config('langVN.validation.course_level_quiz.answer4_required'),
            'correct_answer.required' => config('langVN.validation.course_level_quiz.correct_answer_required'),
        ]);
    }

    /**
     * Validation form page web
     *
     * @param $request
     */
    public static function validatePageWeb($request)
    {
        $request->validate([
            'content' => 'required',
        ], [
            'content' => config('langVN.validation.page.content.required'),
        ]);
    }

    /**
     * Validation form page web
     *
     * @param $request
     */
    public static function validateCourseOnline($request)
    {
        $request->validate([
            'description' => 'required',
        ], [
            'description' => config('langVN.validation.page.content.required'),
        ]);
    }

    /**
     * Validation form page web
     *
     * @param $request
     */
    public static function validateCourseLevel($request)
    {
        $request->validate([
            'description' => 'required',
        ], [
            'description' => config('langVN.validation.page.content.required'),
        ]);
    }

    /**
     * Validation form page web
     *
     * @param $request
     */
    public static function validateCourseThematic($request)
    {
        $request->validate([
            'description' => 'required',
        ], [
            'description' => config('langVN.validation.page.content.required'),
        ]);
    }

    /**
     * Validation form page web
     *
     * @param $request
     */
    public static function validateCourseFree($request)
    {
        $request->validate([
            'description' => 'required',
        ], [
            'description' => config('langVN.validation.page.content.required'),
        ]);
    }

    /**
     * Validation form question
     *
     * @param $request
     */
    public static function validateQuestion($request)
    {
        $request->validate([
            'description' => 'required',
        ], [
            'description' => config('langVN.validation.page.content.required'),
        ]);
    }

    /**
     * Function validate question detail
     *
     * @param $request
     */
    public static function validateQuestionDetail($request)
    {
        $request->validate([
            'question' => 'required|min:3',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'correct_answer' => 'required',
        ], [
            'question.required' => config('langVN.validation.course_level_quiz.quiz_required'),
            'question.min' => config('langVN.validation.course_level_quiz.quiz_min'),
            'answer1.required' => config('langVN.validation.course_level_quiz.answer1_required'),
            'answer2.required' => config('langVN.validation.course_level_quiz.answer2_required'),
            'answer3.required' => config('langVN.validation.course_level_quiz.answer3_required'),
            'answer4.required' => config('langVN.validation.course_level_quiz.answer4_required'),
            'correct_answer.required' => config('langVN.validation.course_level_quiz.correct_answer_required'),
        ]);
    }

    /**
     * Validation form documentation
     *
     * @param $request
     */
    public static function validateDocumentation($request)
    {
        $request->validate([
            'description' => 'required',
        ], [
            'description' => config('langVN.validation.page.content.required'),
        ]);
    }

    public static function validateDocResource($request)
    {
        $request->validate([
            'description' => 'required',
        ], [
            'description' => config('langVN.validation.page.content.required'),
        ]);
    }

    /**
     * Function validate course online source
     *
     * @param $request
     */
    public static function validateCourseOnlineSource($request)
    {
        $request->validate([
            'class_name' => 'required',
            'url_source_class' => 'required',
            'state' => 'required',
            'sort' => 'required',
        ], [
            'class_name.required' => config('langVN.validation.course_online_source.class_name_required'),
            'url_source_class.required' => config('langVN.validation.course_online_source.url_source_class'),
            'state.required' => config('langVN.validation.course_online_source.state_required'),
            'sort.required' => config('langVN.validation.course_online_source.sort_required'),
        ]);
    }

    /**
     * Validation function information of user
     *
     * @param $request
     */
    public static function validateUser($request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'birth_day' => 'required',
            'job' => 'required',
        ], [
            'name.required' => config('langVN.validation.user.name_required'),
            'address.required' => config('langVN.validation.user.address_required'),
            'phone.required' => config('langVN.validation.user.phone_required'),
            'phone.numeric' => config('langVN.validation.user.phone_numeric'),
            'birth_day.required' => config('langVN.validation.user.birth_day_required'),
            'job.required' => config('langVN.validation.user.job_required'),
        ]);
    }
}
