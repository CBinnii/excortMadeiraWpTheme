(() => {
  // NOTICE!!! Initially embedded in our docs this JavaScript
// file contains elements that can help you create reproducible
// use cases in StackBlitz for instance.
// In a real project please adapt this content to your needs.
// ++++++++++++++++++++++++++++++++++++++++++

/*
 * JavaScript for Bootstrap's docs (https://getbootstrap.com/)
 * Copyright 2011-2025 The Bootstrap Authors
 * Licensed under the Creative Commons Attribution 3.0 Unported License.
 * For details, see https://creativecommons.org/licenses/by/3.0/.
 */

/* global bootstrap: false */

// Util: extrai extensão ignorando querystring/fragmento
function getExtension(url) {
  try {
    // Remove query/hash e pega a última parte
    const clean = url.split('#')[0].split('?')[0];
    const last = clean.split('/').pop() || "";
    const parts = last.split('.');
    if (parts.length < 2) return "";
    return parts.pop().toLowerCase();
  } catch {
    return "";
  }
}

const snippets_default = () => {
  const VIDEO_EXTENSIONS = ["mp4", "webm", "ogg"];
  const exampleModal = document.getElementById('exampleModal')
  if (exampleModal) {
    exampleModal.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const title = button.getAttribute('data-bs-title');
      const image = button.getAttribute('data-bs-image');
      const link = button.getAttribute('data-bs-link');
      const description = button.getAttribute('data-bs-description');
      const location = button.getAttribute('data-bs-location');
      // If necessary, you could initiate an Ajax request here
      // and then do the updating in a callback.

      // Update the modal's content.
      const modalBody = exampleModal.querySelector('.modal-body');
      const modalTitle = exampleModal.querySelector('.modal-body h2');
      const modalLink = exampleModal.querySelector('.modal-body a');
      const modalLocation = exampleModal.querySelector('.modal-body p#location');
      const modalDescription = exampleModal.querySelector('.modal-body p#description');
      const mediaSlot = modalBody.querySelector('.media-slot');

      modalTitle.textContent = title;
      modalLocation.textContent = location;
      modalLink.href = link;
      modalDescription.textContent = description;
      
      // Decide mídia
      const ext = getExtension(image);
      const isVideo = VIDEO_EXTENSIONS.includes(ext);

      // Limpa o slot antes de injetar
      mediaSlot.innerHTML = "";

      if (isVideo) {
        // Monta vídeo com source tipado
        mediaSlot.innerHTML = `
          <video
            autoplay
            loop
            muted
            playsinline
            preload="metadata"
            style="width:100%;height:auto;object-fit:cover;border-radius:.5rem;"
          >
            <source src="${image}" type="video/${ext}">
            Seu navegador não suporta vídeo.
          </video>
        `;
      } else {
        // Monta imagem
        mediaSlot.innerHTML = `
          <img
            src="${image}"
            alt="${title ? title.replace(/"/g, '&quot;') : ''}"
            style="width:100%;height:auto;object-fit:cover;border-radius:.5rem;"
            loading="lazy"
          >
        `;
      }
    });
    
    // Opcional: ao fechar a modal, pausa o vídeo e libera memória
    exampleModal.addEventListener('hidden.bs.modal', () => {
      const video = exampleModal.querySelector('.media-slot video');
      if (video) {
        try { video.pause(); } catch {}
        video.removeAttribute('src');
        const source = video.querySelector('source');
        if (source) source.remove();
      }
    });
  }
}
  snippets_default();
})();