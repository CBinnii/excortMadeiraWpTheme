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

const snippets_default = () => {
  // -------------------------------
  // Modal
  // -------------------------------
  // Modal 'Varying modal content' example in docs and StackBlitz
  // js-docs-start varying-modal-content
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
      const modalImage = exampleModal.querySelector('.modal-body img');
      const modalTitle = exampleModal.querySelector('.modal-body h2');
      const modalLink = exampleModal.querySelector('.modal-body a');
      const modalLocation = exampleModal.querySelector('.modal-body p#location');
      const modalDescription = exampleModal.querySelector('.modal-body p#description');

      modalImage.src = image;
      modalTitle.textContent = title;
      modalLocation.textContent = location;
      modalLink.href = link;
      modalDescription.textContent = description;
    })
  }
  // js-docs-end varying-modal-content
}


  // <stdin>
  snippets_default();
})();