import pygame
import random

# Initialisation de Pygame
pygame.init()

# Définir la taille de la fenêtre
largeur_fenetre = 800
hauteur_fenetre = 400
fenetre = pygame.display.set_mode((largeur_fenetre, hauteur_fenetre))
pygame.display.set_caption("T-Rex Runner")

# Couleurs
blanc = (255, 255, 255)

# Chargez l'image du T-Rex
trex_image = pygame.image.load("/assets/images/trex.png")
trex_rect = trex_image.get_rect()
trex_rect.topleft = (50, hauteur_fenetre - trex_rect.height)

# Variables de jeu
gravite = 0.5
saut = False
vitesse_saut = -10
sol_y = hauteur_fenetre - 50

cactus_list = []
spawn_cactus_event = pygame.USEREVENT + 1
pygame.time.set_timer(spawn_cactus_event, 1500)
cactus_image = pygame.image.load("/assets/images/cactus.png")

score = 0
font = pygame.font.Font(None, 36)

def afficher_score():
    score_text = font.render(f"Score: {score}", True, blanc)
    fenetre.blit(score_text, (10, 10))

def collision(trex_rect, cactus_rect):
    return trex_rect.colliderect(cactus_rect)

running = True
while running:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            running = False
        if event.type == pygame.KEYDOWN:
            if event.key == pygame.K_SPACE and not saut:
                saut = True
        if event.type == spawn_cactus_event:
            cactus_rect = cactus_image.get_rect()
            cactus_rect.topleft = (largeur_fenetre, sol_y - cactus_rect.height)
            cactus_list.append(cactus_rect)

    keys = pygame.key.get_pressed()
    if keys[pygame.K_DOWN]:
        saut = False

    for cactus_rect in cactus_list:
        cactus_rect.x -= 10
        if cactus_rect.right < 0:
            cactus_list.remove(cactus_rect)
            score += 1

        if collision(trex_rect, cactus_rect):
            running = False

    if saut:
        trex_rect.y += vitesse_saut
        vitesse_saut += gravite
        if trex_rect.y >= sol_y - trex_rect.height:
            trex_rect.y = sol_y - trex_rect.height
            saut = False
            vitesse_saut = -10

    fenetre.fill((0, 0, 0))
    fenetre.blit(trex_image, trex_rect)
    afficher_score()

    for cactus_rect in cactus_list:
        fenetre.blit(cactus_image, cactus_rect)

    pygame.display.update()

pygame.quit()
