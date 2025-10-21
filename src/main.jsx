import React from 'react';
import { createRoot } from 'react-dom/client';
import CategoryGrid from './components/CategoryGrid.jsx';


const root = document.getElementById('oc-root');
if (root) {
  createRoot(root).render(
    <CategoryGrid />
  );
}
