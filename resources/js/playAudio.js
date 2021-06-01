/**
 * Function play file sound
 *
 * @param idSource
 * @param type
 */
window.playAudio = function(idSource, type) {
    let _audio = new Audio($("#path_sound_"+type+"_" + idSource).val());
    _audio.play();
};

/**
 * Function pause file sound
 *
 * @param _audio
 */
window.pauseSound = function (_audio) {
    _audio.pause();
};
