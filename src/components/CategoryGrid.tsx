import React from 'react';

interface Product {
  id: number;
  title: string;
  image: string;
  price: number;
}

interface Props {
  products: Product[];
}

const CategoryGrid: React.FC<Props> = ({ products }) => {
  return (
    <div className="category-grid" style={{ padding: '20px' }}>
      <div style={{
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))',
        gap: '20px',
      }}>
        {products.map((p) => (
          <div key={p.id} className="product-card" style={{
            border: '1px solid #ddd',
            borderRadius: '8px',
            padding: '15px',
            textAlign: 'center',
          }}>
            <img src={p.image} alt={p.title} style={{
              width: '100%',
              height: '150px',
              objectFit: 'cover',
              borderRadius: '6px'
            }} />
            <h3>{p.title}</h3>
            <p style={{ color: '#555' }}>${p.price}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default CategoryGrid;
