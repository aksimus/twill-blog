/**
 * Table of Contents smooth scroll handler
 * Handles anchor links when base tag is present
 */

export default function initTableOfContents() {
    const tocLinks = document.querySelectorAll('.toc-link');
    
    tocLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        
        if (href && href.startsWith('#')) {
          const targetId = href.substring(1);
          const targetElement = document.getElementById(targetId);
          
          if (targetElement) {
            e.preventDefault();
            e.stopPropagation();
            
            // Calculate offset for fixed header
            const offsetTop = targetElement.offsetTop - 100;
            
            // Smooth scroll
            window.scrollTo({
              top: offsetTop,
              behavior: 'smooth'
            });
            
            // Update URL hash without page jump
            if (history.pushState) {
              const currentPath = window.location.pathname;
              history.pushState(null, null, currentPath + '#' + targetId);
            }
            
            return false;
          }
        }
      });
    });
  }
  
  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTableOfContents);
  } else {
    initTableOfContents();
  }