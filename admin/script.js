document.addEventListener('DOMContentLoaded', () => {
  // Navbar hide-on-scroll
  const menuLinks = document.querySelector('#menu-links');
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
      navbar.style.top = '-100px';
    } else {
      navbar.style.top = '0';
    }
  });

  // Toggle menu
  window.toggleMenu = function () {
    menuLinks.classList.toggle('show-menu');
  };

  // Phototype preview (if present)
  const radios = document.querySelectorAll('input[name="phototype"]');
  const previewImg = document.getElementById('style-preview');
  if (radios.length && previewImg) {
    const paths = {
      sketch: '../images/sketch.png',
      render: '../images/render.jpg',
      reality: '../images/reality.png'
    };
    function updatePreview() {
      const sel = document.querySelector('input[name="phototype"]:checked');
      if (!sel) return;
      previewImg.src = paths[sel.value] || previewImg.src;
    }
    radios.forEach(r => r.addEventListener('change', updatePreview));
    updatePreview();
  }

  // PDF Viewer functionality
  let currentPDF = null;
  let currentPage = 1;
  let totalPages = 1;

  // Only open modal if not clicking the delete button/form
  document.querySelectorAll('.project-card').forEach(card => {
    card.addEventListener('click', (e) => {
      if (e.target.closest('form')) return; // Prevent modal on delete
      const pdfPath = card.dataset.pdf;
      if (pdfPath) {
        openPDF(pdfPath);
      } else {
        console.warn('No PDF path provided in data-pdf attribute.');
      }
    });
  });

  async function openPDF(pdfPath) {
    try {
      const loadingTask = pdfjsLib.getDocument(pdfPath);
      currentPDF = await loadingTask.promise;
      totalPages = currentPDF.numPages;
      document.querySelector('.pdf-modal').style.display = 'block';
      document.getElementById('total-pages').textContent = totalPages;
      renderPage(1);
    } catch (err) {
      console.error('Error loading PDF:', err);
      alert('Error loading PDF document');
    }
  }

  async function renderPage(pageNum) {
    if (!currentPDF || pageNum < 1 || pageNum > totalPages) return;
    const page = await currentPDF.getPage(pageNum);
    const canvas = document.getElementById('pdf-canvas');
    const context = canvas.getContext('2d');
    const viewport = page.getViewport({ scale: 1.2 });
    canvas.height = viewport.height;
    canvas.width = viewport.width;
    await page.render({
      canvasContext: context,
      viewport: viewport
    }).promise;
    currentPage = pageNum;
    document.getElementById('current-page').textContent = currentPage;
  }

  // Modal controls
  const closeBtn = document.querySelector('.close-pdf');
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      document.querySelector('.pdf-modal').style.display = 'none';
      currentPDF = null;
    });
  }

  const prevBtn = document.querySelector('.prev-page');
  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      renderPage(currentPage - 1);
    });
  }

  const nextBtn = document.querySelector('.next-page');
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      renderPage(currentPage + 1);
    });
  }

  // Close modal when clicking outside modal content
  window.addEventListener('click', (event) => {
    const modal = document.querySelector('.pdf-modal');
    if (event.target === modal) {
      modal.style.display = 'none';
      currentPDF = null;
    }
  });
});