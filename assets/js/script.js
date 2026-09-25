// ==========================================================
// Mobile Shop Management System - Global JS
// ==========================================================

document.addEventListener('DOMContentLoaded', () => {
  console.log('Mobile Shop Management System - JS loaded');

  // Example: sidebar active link highlight
  const links = document.querySelectorAll('.sidebar-link');
  links.forEach(link => {
    link.addEventListener('click', () => {
      links.forEach(l => l.classList.remove('active'));
      link.classList.add('active');
    });
  });
});
