import React from 'react';
import { createRoot } from 'react-dom/client';
import CategorySwitcher from './components/CategorySwitcher';
import './scss/_variables.scss';

function App() {
  const mockCategories = [
    {
      id: 1,
      name: 'Dogs',
      products: [
        { id: 1, title: 'Dog Food', image: 'https://via.placeholder.com/150', price: 25 },
        { id: 2, title: 'Leash', image: 'https://via.placeholder.com/150', price: 15 },
      ],
    },
    {
      id: 2,
      name: 'Cats',
      products: [
        { id: 3, title: 'Cat Food', image: 'https://via.placeholder.com/150', price: 22 },
        { id: 4, title: 'Toy', image: 'https://via.placeholder.com/150', price: 9 },
      ],
    },
  ];

  return (
    <div style={{ textAlign: 'center', padding: '20px' }}>
      <h2>🚀 Category Switcher Test</h2>
      <CategorySwitcher categories={mockCategories} />
    </div>
  );
}

const root = document.getElementById('oc-root');
if (root) createRoot(root).render(<App />);
