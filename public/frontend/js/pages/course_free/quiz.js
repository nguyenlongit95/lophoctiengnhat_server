
/**
 * Function choose a answer in quiz
 *
 * @param quiz int id of quiz
 * @param answer int value of correct choose
 */
function chooseYourAnswer(quiz, answer) {
    // Disabled input radio control
    $('.quiz_answer_' + quiz).attr('disabled', 'disabled');

    // Process your choice of answers
    let correctAnswer = parseInt($('#quiz-correct-answer-' + quiz).val());
    let numberAnswerCorrect = parseInt($('#number-of-answers-correct-course-free').text());
    // change color
    $('#answer-label-' + quiz + '-' + correctAnswer).css('color', 'rgb(73, 142, 17)');
    if (answer === correctAnswer) {
        // Add number total answer correct
        $('#number-of-answers-correct-course-free').text(numberAnswerCorrect + 1);
    } else {
        // Change color answer
        $('#answer-label-' + quiz + '-' + answer).css('color', '#900');
        $('.mark-' + quiz + '-' + answer).css('background-color', '#900');
        $('.mark-' + quiz + '-' + answer).addClass('wrong-answer');
        $('.mark-' + quiz + '-' + correctAnswer).css('background-color', 'rgb(73, 142, 17)');
        $('.mark-' + quiz + '-' + correctAnswer).addClass('correct-checkmark');
    }
}
