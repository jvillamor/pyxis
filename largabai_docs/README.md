# Largabai Website

Largabai is a warm, storybook-inspired landing-page experience centered on three AI companions sharing one outdoor moment.

> **Different minds. One journey.**  
> **Working as one.**

## Characters

- **Granny Basyang** — the grandmother seated at the center of the scene.
- **Chino** — the blue dinosaur reading a book.
- **Glowy** — the cat with the “Larga, bai?” thought bubble.

## Asset directory

All approved Largabai artwork is stored in [`asset/`](./asset/).

| File | Purpose |
| --- | --- |
| `site_background.png` | Main garden environment |
| `GrannyBasyang.png` | Granny Basyang character artwork |
| `Chino1.png` | Primary Chino artwork used in the landing page |
| `Chino2.png` | Alternate Chino artwork |
| `Glowy.png` | Primary Glowy artwork with the “Larga, bai?” bubble |
| `Glowy1.png` | Alternate Glowy artwork |
| `slogan.png` | Transparent slogan artwork |
| `Proposed_design.png` | Original composition and visual reference |

## Composition rules

- Keep Granny Basyang centered between Chino and Glowy.
- Preserve the character artwork exactly; do not redraw, recolor, distort, or crop any character.
- Preserve “Larga, bai?” from Glowy’s artwork.
- Keep the slogan transparent and visually secondary to the characters.
- The garden background may cover the viewport, but all three characters must remain visible at important desktop and mobile breakpoints.
- Do not add navigation, logos, buttons, calls to action, product descriptions, contact forms, or corporate content to the landing page.

## Motion rules

Environmental animation should remain subtle and lightweight:

- gentle, irregular movement in leaves and edge foliage;
- slowly shifting dappled sunlight;
- very subtle floating dust or pollen;
- no movement applied to Granny Basyang, Chino, Glowy, or the slogan;
- honor the user's `prefers-reduced-motion` setting.

## Interaction

Only Glowy’s **“Larga, bai?”** thought bubble is interactive. It links to:

<https://dersatoolforthat.largabai.com/?i=1>

The bubble should provide a subtle hover and keyboard-focus indication while leaving Glowy herself non-clickable.
