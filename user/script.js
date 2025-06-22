// script.js
/*
document.addEventListener('DOMContentLoaded', () => {
  console.log('📘 script.js loaded, DOM ready');

  // ─── Navbar hide-on-scroll ────────────────────────
  const menuLinks = document.querySelector('#menu-links');
  const navbar = document.querySelector('nav');
  window.addEventListener('scroll', () => {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
      navbar.style.top = '-100px';
    } else {
      navbar.style.top = '0';
    }
  });
  // Expose toggleMenu for your HTML onclick if needed
  window.toggleMenu = () => menuLinks.classList.toggle('show-menu');

  // ─── Phototype preview (only if elements exist) ───
  const radios = document.querySelectorAll('input[name="phototype"]');
  const previewImg = document.getElementById('style-preview');
  if (radios.length && previewImg) {
    console.log('🔄 Initializing phototype preview');
    const paths = {
      sketch: './images/sketch.png',
      render: './images/render.jpg',
      reality: './images/reality.png'
    };

    function updatePreview() {
      const sel = document.querySelector('input[name="phototype"]:checked');
      if (!sel) return;
      previewImg.src = paths[sel.value] || previewImg.src;
    }

    radios.forEach(r => r.addEventListener('change', updatePreview));
    updatePreview();
  } else {
    console.log('— skipping phototype preview (no matching elements)');
  }

  // ─── PDF Viewer setup ─────────────────────────────
  let currentPDF = null, currentPage = 1, totalPages = 1;
  const cards = document.querySelectorAll('.project-card');
  console.log(`🃏 Found ${cards.length} project cards`);

  cards.forEach(card => {
    card.addEventListener('click', () => {
      const path = card.dataset.pdf;
      console.log('🖱️ clicked card, loading PDF:', path);
      openPDF(path);
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
      console.error('❌ Error loading PDF:', err);
      alert('Error loading PDF document');
    }
  }

  async function renderPage(pageNum) {
    if (!currentPDF || pageNum < 1 || pageNum > totalPages) return;
    const page = await currentPDF.getPage(pageNum);
    const canvas = document.getElementById('pdf-canvas');
    const ctx = canvas.getContext('2d');
    const vp = page.getViewport({ scale: 1.5 });
    canvas.width = vp.width;
    canvas.height = vp.height;
    await page.render({ canvasContext: ctx, viewport: vp }).promise;
    currentPage = pageNum;
    document.getElementById('current-page').textContent = currentPage;
  }

  // Modal controls
  document.querySelector('.close-pdf').addEventListener('click', () => {
    document.querySelector('.pdf-modal').style.display = 'none';
    currentPDF = null;
  });
  document.querySelector('.prev-page').addEventListener('click', () => {
    renderPage(currentPage - 1);
  });
  document.querySelector('.next-page').addEventListener('click', () => {
    renderPage(currentPage + 1);
  });
  window.addEventListener('click', e => {
    const modal = document.querySelector('.pdf-modal');
    if (e.target === modal) {
      modal.style.display = 'none';
      currentPDF = null;
    }
  });
});

*/
let menuLinks = document.querySelector('#menu-links')


// NAVBAR FUNCTION WHILE SCROLL ON Y
let lastScroll = 0;
const navbar = document.querySelector('nav');
const navbarHeight = navbar.offsetHeight; // Get actual nav height

window.addEventListener('scroll', () => {
   if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
     document.getElementById("navbar").style.top = "-100px";
  } else {
   
        document.getElementById("navbar").style.top = "0";

  }
});

// TOGGLE BAR
function toggleMenu() {
  menuLinks.classList.toggle('show-menu');
}

document.addEventListener('DOMContentLoaded', () => {
  const radioButtons = document.querySelectorAll('input[name="phototype"]');
  const previewImage = document.getElementById('style-preview');
  
  const imagePaths = {
    sketch: '../images/sketch.png',
    render: '../images/render.jpg',
    reality: './images/reality.png'
  };

  // Update image function
  function updatePreviewImage() {
    const selectedStyle = document.querySelector('input[name="phototype"]:checked').value;
    previewImage.src = imagePaths[selectedStyle];
    
  }

  // Add event listeners to all radio buttons
  radioButtons.forEach(radio => {
    radio.addEventListener('change', updatePreviewImage);
  });

  // Initialize with default image
  updatePreviewImage();
});

// PDF Viewer functionality
let currentPDF = null;
let currentPage = 1;
let totalPages = 1;

document.querySelectorAll('.project-card').forEach(card => {
    card.addEventListener('click', () => {
      
        const pdfPath = card.dataset.pdf;
       if(pdfPath){
        openPDF(pdfPath);
       }else{
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

// Controls
document.querySelector('.close-pdf').addEventListener('click', () => {
    document.querySelector('.pdf-modal').style.display = 'none';
    currentPDF = null;
});

document.querySelector('.prev-page').addEventListener('click', () => {
    renderPage(currentPage - 1);
});

document.querySelector('.next-page').addEventListener('click', () => {
    renderPage(currentPage + 1);
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.querySelector('.pdf-modal');
    if (event.target === modal) {
        modal.style.display = 'none';
        currentPDF = null;
    }
};