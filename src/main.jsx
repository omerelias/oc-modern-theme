import React from 'react';
import { createRoot } from 'react-dom/client';
import CategoryGrid from './components/CategoryGrid.jsx';

function App() {
  console.log('✅ App rendered');
  return (
    <div>
      <h2>🚀 OC Modern Theme Test</h2>
      <CategoryGrid />
    </div>
  );
}

const root = document.getElementById('oc-root');
if (root) {
  createRoot(root).render(<App />);
}
