const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

const trexImage = new Image();
trexImage.src = "/assets/images/flopman.png";

const cactusImage = new Image();
cactusImage.src = "/assets/images/cactus.png";
cactusImage.style.height = "100";

const gravity = 1;
let jumping = false;
let jumpSpeed = 15;
const groundY = canvas.height - trexImage.height - 50;

let trexX = 50;
let trexY = groundY;
let trexYSpeed = 0;

const cactusList = [];
const spawnCactusInterval = 1500;
let score = 0;

const font = "36px Arial";

function drawTrex() {
    ctx.drawImage(trexImage, trexX, trexY);
}

function drawCactus(x, y) {
    ctx.drawImage(cactusImage, x, y);
}

function collision(trexX, trexY, cactusX, cactusY) {
    return (
        trexX < cactusX + cactusImage.width &&
        trexX + trexImage.width > cactusX &&
        trexY < cactusY + cactusImage.height &&
        trexY + trexImage.height > cactusY
    );
}

function updateGame() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    if (jumping) {
        trexY -= jumpSpeed;
        jumpSpeed -= gravity;
        if (trexY >= groundY) {
            trexY = groundY;
            jumping = false;
            jumpSpeed = 15;
        }
    } else {
        trexY += trexYSpeed;
        trexYSpeed += gravity;
        if (trexY >= groundY) {
            trexY = groundY;
            trexYSpeed = 0;
        }
    }

    drawTrex();

    for (let i = 0; i < cactusList.length; i++) {
        cactusList[i].x -= 10;
        drawCactus(cactusList[i].x, cactusList[i].y);

        if (cactusList[i].x + cactusImage.width < 0) {
            cactusList.splice(i, 1);
            i--;
            score++;
        }

        if (collision(trexX, trexY, cactusList[i].x, cactusList[i].y)) {
            alert("Game Over! Your Score: " + score);
            document.location.reload();
        }
    }

    drawScore();
    requestAnimationFrame(updateGame);
}

function drawScore() {
    ctx.font = font;
    ctx.fillStyle = "white";
    ctx.fillText("Score: " + score, 10, 30);
}

document.addEventListener("keydown", function (event) {
    if (event.key === " " && !jumping) {
        jumping = true;
        jumpSpeed = 15;
    }
});

setInterval(function () {
    const cactusY = groundY - cactusImage.height + 300;
    cactusList.push({ x: canvas.width, y: cactusY });
}, spawnCactusInterval);

updateGame();
