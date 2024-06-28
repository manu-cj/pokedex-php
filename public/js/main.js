document.addEventListener("DOMContentLoaded", () => {
  let pokemonInfos = document.querySelectorAll(".pokemon-info");
  pokemonInfos.forEach((pokemonInfo) => {
    let pokemonName = pokemonInfo.querySelector("h2");
    let pokemonImg = document.querySelector(".card-image");
    console.log();
    let isUserInteracted = false;
    function lowercaseFirstLetter(str) {
      if (typeof str !== "string" || str.length === 0) {
        return str; // Retourner la valeur originale si ce n'est pas une chaîne ou si elle est vide
      }
      return str.charAt(0).toLowerCase() + str.slice(1);
    }

    function playSound() {
      if (isUserInteracted) {
        audio.play().catch((error) => {
          console.error("Erreur lors de la lecture du son :", error);
        });
      }
    }

    const audio = new Audio(
      "https://play.pokemonshowdown.com/audio/cries/" +
        lowercaseFirstLetter(pokemonName.textContent) +
        ".mp3"
    );
    console.log(audio);
    pokemonImg.addEventListener("mouseover", () => {
      isUserInteracted = true;
      playSound();
    });
  });
});
