import React from 'react';
import { createRoot } from 'react-dom/client';
import CvBuilder from './components/cv/CvBuilder';

// Mount only when element exists
document.addEventListener('DOMContentLoaded', () => {
  const element = document.getElementById('cv-builder-app');
  if (element) {
    const root = createRoot(element);
    root.render(<CvBuilder />);
  }
});