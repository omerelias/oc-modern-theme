import React, { useState } from 'react';
import CategoryGrid from './CategoryGrid';

interface Product {
  id: number;
  title: string;
  image: string;
  price: number;
}

interface Category {
  id: number;
  name: string;
  products: Product[];
}

interface Props {
  categories: Category[];
}

const CategorySwitcher: React.FC<Props> = ({ categories }) => {
  const [activeCategory, setActiveCategory] = useState(categories[0]);

  return (
    <div className="category-switcher">
      <div className="category-tabs" style={{ display: 'flex', gap: '10px', justifyContent: 'center' }}>
        {categories.map((cat) => (
          <button
            key={cat.id}
            className={`tab ${cat.id === activeCategory.id ? 'active' : ''}`}
            onClick={() => setActiveCategory(cat)}
            style={{
              padding: '8px 16px',
              borderRadius: '6px',
              border: cat.id === activeCategory.id ? '2px solid #00b7ff' : '1px solid #ccc',
              backgroundColor: cat.id === activeCategory.id ? '#e6f7ff' : '#fff',
              cursor: 'pointer',
            }}
          >
            {cat.name}
          </button>
        ))}
      </div>

      <CategoryGrid products={activeCategory.products} />
    </div>
  );
};

export default CategorySwitcher;
