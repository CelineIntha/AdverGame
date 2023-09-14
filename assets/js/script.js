const gameContainer = document.getElementById("game-container");
const trex = document.getElementById("trex");
const scoreDisplay = document.getElementById("score");
const gameOverScreen = document.getElementById("game-over");
const gameOverScoreDisplay = document.getElementById("game-over-score");
let canDoubleJump = true;
let isJumping = false;
let score = 0;
let gameIsOver = false;

function jump() {
    if (!isJumping && !gameIsOver) {
        isJumping = true;
        let jumpHeight = 0;
        const jumpInterval = setInterval(() => {
            if (jumpHeight < 100) {
                jumpHeight += 8;
                trex.style.bottom = jumpHeight + "px";
            } else {
                clearInterval(jumpInterval);
                const fallInterval = setInterval(() => {
                    if (jumpHeight > 0) {
                        jumpHeight -= 5;
                        trex.style.bottom = jumpHeight + "px";
                    } else {
                        clearInterval(fallInterval);
                        isJumping = false;
                    }
                }, 30);
            }
        }, 30);
    }
}

function createCactusWithRandomIntervalAndPosition() {
    if (!gameIsOver) {
        const cactus = document.createElement("div");
        cactus.classList.add("cactus");
        const cactusPosition = 800;
        const randomPosition = Math.floor(Math.random() * 400) + 800; // Position horizontale aléatoire entre 800 et 1200 pixels (réduite à 800 et 1200)
        cactus.style.left = randomPosition + "px";
        cactus.style.bottom = "0px"; // Vous pouvez définir la hauteur de manière fixe si vous le souhaitez
        gameContainer.appendChild(cactus);

        const moveCactus = setInterval(() => {
            const cactusLeft = parseInt(getComputedStyle(cactus).left);
            if (cactusLeft > -20) {
                cactus.style.left = (cactusLeft - 5) + "px";
            } else {
                clearInterval(moveCactus);
                gameContainer.removeChild(cactus);
            }

            const trexBottom = parseInt(getComputedStyle(trex).bottom);
            const trexLeft = parseInt(getComputedStyle(trex).left);
            const trexRight = trexLeft + 50;
            const cactusRight = cactusLeft + 8;

            if (
                trexBottom <= 40 &&
                trexRight >= cactusLeft &&
                trexLeft <= cactusRight
            ) {
                clearInterval(moveCactus);
                endGame();
            }
        }, 20);

        // Générer un délai aléatoire entre les apparitions des cactus (entre 1 et 3 secondes)
        const randomInterval = Math.floor(Math.random() * 2000) + 1000;
        setTimeout(createCactusWithRandomIntervalAndPosition, randomInterval);
    }
}

// Appel initial pour commencer le jeu
createCactusWithRandomIntervalAndPosition();

function updateScore() {
    if (!gameIsOver) {
        score++;
        scoreDisplay.textContent = score;
    }
}

function endGame() {
    gameIsOver = true;
    gameOverScoreDisplay.textContent = score;
    gameOverScreen.style.display = "flex";
}

// function restartGame() {
//     location.reload();
// }

document.addEventListener("keydown", (event) => {
    if (event.key === "Spacebar" || event.key === " ") {
        jump();
    }
});

setInterval(updateScore, 100);

let viewRank = document.querySelector('#rank')

viewRank.addEventListener('click', function () {
    window.location.replace('form.html?res=' + score)
})