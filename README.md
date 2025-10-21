# 🚀 OC Modern Theme - WordPress + React + Vite

תבנית WordPress מודרנית המשלבת React עם Vite לפיתוח מהיר וחוויית משתמש מעולה.

## 📋 תוכן עניינים

- [התקנה ראשונית](#התקנה-ראשונית)
- [פיתוח](#פיתוח)
- [בנייה לייצור](#בנייה-לייצור)
- [הסבר על Constants](#הסבר-על-constants)
- [אוטומציה עם GitHub](#אוטומציה-עם-github)
- [מבנה הפרויקט](#מבנה-הפרויקט)
- [פיתוח רכיבים](#פיתוח-רכיבים)

## 🛠️ התקנה ראשונית

### 1. התקנת Node.js
```bash
# הורד והתקן Node.js מ: https://nodejs.org
# וודא שיש לך גרסה 18+ 
node --version
```

### 2. התקנת תלויות
```bash
# בתיקיית התבנית
npm install
```

### 3. הגדרת מצב פיתוח
```php
// functions.php - שורה 3
define('OC_THEME_DEV_MODE', true);  // ✅ מצב פיתוח
```

## 🚀 פיתוח

### הפעלת שרת פיתוח
```bash
npm run dev
```

**מה קורה:**
- Vite server רץ על `http://localhost:5173`
- Hot Module Replacement (HMR) פעיל
- שינויים בקוד מתעדכנים אוטומטית בדפדפן
- React components נטענים ישירות מ-Vite

### בדיקה שהכל עובד
1. פתח את האתר ב-WordPress
2. אמור לראות: "Category Switcher Test"
3. אמור לראות מוצרים עם תמונות
4. נסה לשנות משהו ב-`src/main.tsx` - אמור להתעדכן אוטומטית

## 🏗️ בנייה לייצור

### בניית הקבצים
```bash
npm run build
```

**מה קורה:**
- הקבצים נבנים לתיקיית `dist/`
- מיניפיקציה ואופטימיזציה
- חלוקה ל-chunks (vendor + main)
- CSS נפרד לקבצים נפרדים

### הגדרת מצב ייצור
```php
// functions.php - שורה 3
define('OC_THEME_DEV_MODE', false); // ✅ מצב ייצור
```

**מה קורה:**
- WordPress טוען קבצים מ-`dist/`
- ללא Vite server
- קבצים אופטימליים ומהירים

## ⚙️ הסבר על Constants

### OC_THEME_DEV_MODE
```php
define('OC_THEME_DEV_MODE', true);  // פיתוח
define('OC_THEME_DEV_MODE', false); // ייצור
```

**הבדל בתכלס:**
- **true**: טוען מ-Vite server (מהיר לפיתוח, HMR)
- **false**: טוען מ-dist/ (אופטימלי לייצור, ללא תלות בשרת)

### OC_THEME_VITE_PORT
```php
define('OC_THEME_VITE_PORT', 5173); // פורט Vite
```

**מתי לשנות:**
- אם Vite רץ על פורט אחר
- אם יש קונפליקט עם שירות אחר

## 🤖 אוטומציה עם GitHub

### GitHub Actions
הפרויקט כולל אוטומציה מלאה:

1. **על כל Push:**
   - בדיקת קוד (ESLint)
   - בנייה אוטומטית
   - העלאה ל-Server (אם מוגדר)

2. **על כל Pull Request:**
   - בדיקות איכות קוד
   - בנייה ובדיקה

### הגדרת Secrets (אופציונלי)
```bash
# ב-GitHub Repository Settings > Secrets
DEPLOY_HOST=your-server.com
DEPLOY_USER=username
DEPLOY_PASS=password
```

## 📁 מבנה הפרויקט

```
oc-modern-theme/
├── src/                    # קוד React
│   ├── main.tsx            # נקודת כניסה
│   ├── components/         # רכיבי React
│   └── scss/              # עיצוב
├── inc/                   # PHP helpers
│   └── enqueue.php       # ניהול נכסים
├── dist/                 # קבצים בנויים (אוטומטי)
├── functions.php         # WordPress hooks
├── index.php            # תבנית ראשית
└── style.css           # מטא-דאטה של התבנית
```

## 🎨 פיתוח רכיבים

### יצירת רכיב חדש
```typescript
// src/components/MyComponent.tsx
import React from 'react';

interface Props {
  title: string;
}

const MyComponent: React.FC<Props> = ({ title }) => {
  return <h1>{title}</h1>;
};

export default MyComponent;
```

### שימוש ברכיב
```typescript
// src/main.tsx
import MyComponent from './components/MyComponent';

function App() {
  return <MyComponent title="Hello World" />;
}
```

### עיצוב עם SCSS
```scss
// src/scss/_variables.scss
$primary-color: #00b7ff;
$secondary-color: #333;
```

## 🔧 פקודות שימושיות

```bash
# פיתוח
npm run dev          # הפעלת שרת פיתוח
npm run build        # בנייה לייצור
npm run lint         # בדיקת קוד
npm run preview      # תצוגה מקדימה של build

# ניקוי
npm run clean        # מחיקת dist/
```

## 🐛 פתרון בעיות

### Vite לא עובד
1. בדוק ש-`OC_THEME_DEV_MODE = true`
2. וודא ש-`npm run dev` רץ
3. בדוק שהפורט 5173 פנוי

### Build לא עובד
1. בדוק ש-`OC_THEME_DEV_MODE = false`
2. הרץ `npm run build`
3. בדוק שיש תיקיית `dist/`

### רכיבים לא נטענים
1. בדוק את ה-console בדפדפן
2. וודא שיש `#oc-root` ב-HTML
3. בדוק את ה-network tab

## 📚 מה יש כרגע באפליקציה

האפליקציה הנוכחית כוללת:

### CategorySwitcher
- רכיב React שמציג קטגוריות מוצרים
- מעבר בין קטגוריות (Dogs/Cats)
- מוצרים עם תמונות ומחירים
- עיצוב responsive

### CategoryGrid  
- רכיב לתצוגת מוצרים בגריד
- תמיכה ב-TypeScript
- עיצוב מודרני

**זה נטו כדי להוכיח ש-React עובד ב-WordPress!** 🎉

## 🚀 צעדים הבאים

1. **התחל עם `npm run dev`**
2. **שחק עם הקטגוריות**
3. **נסה לשנות משהו ב-`src/main.tsx`**
4. **צור רכיב חדש**
5. **בנה לייצור עם `npm run build`**

---

**הערה:** זהו פרויקט היברידי - WordPress + React. הכל עובד יחד בצורה חלקה! 🚀