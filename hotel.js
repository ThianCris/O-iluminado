
document.addEventListener('DOMContentLoaded', function() {
    var audio = document.getElementById('background-audio');
    if (audio) {
      audio.play().catch(function(error) {
        console.log("Autoplay foi bloqueado: " + error);
      });
    }
  });
  