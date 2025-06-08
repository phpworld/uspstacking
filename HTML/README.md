# USPS-Inspired Bootstrap 5 Website

A modern, responsive website design inspired by the United States Postal Service (USPS) website, built with Bootstrap 5 and enhanced with custom CSS and JavaScript.

## 🚀 Features

### Design & Layout

- **Responsive Design**: Mobile-first approach with Bootstrap 5
- **USPS-Inspired UI**: Clean, professional design matching USPS aesthetics
- **Modern Navigation**: Multi-level dropdown menus with hover effects
- **Hero Section**: Eye-catching banner with call-to-action buttons
- **Interactive Carousel**: Product showcase with touch/swipe support
- **Grid Layouts**: Service cards and quick tools in organized grids

### Functionality

- **Search Functionality**: Auto-complete search with suggestions
- **Accessibility**: WCAG compliant with keyboard navigation
- **Performance Optimized**: Lazy loading and optimized animations
- **Cross-Browser Compatible**: Works on all modern browsers
- **Touch-Friendly**: Mobile gestures and touch interactions

### Components

- **Utility Bar**: Language selector and quick links
- **Main Navigation**: Simple 6-page menu system
- **Quick Tools**: Icon-based service shortcuts
- **Featured Services**: Highlighted USPS services
- **Product Carousel**: Rotating showcase of products
- **Updates Section**: News and alerts
- **Footer**: Comprehensive links and social media

### Pages Included

- **Home** (`index.html`) - Main landing page with hero section and features
- **About Us** (`about.html`) - Information about USPS mission and services
- **SEND** (`send.html`) - Shipping services, tools, and pricing
- **RECEIVE** (`receive.html`) - Mail management and tracking services
- **FAQ** (`faq.html`) - Frequently asked questions with accordion interface
- **Tracking** (`tracking.html`) - Package tracking with sample results

## 📁 File Structure

```
/
├── index.html                 # Main HTML file
├── css/
│   ├── style.css             # Custom styles
│   └── responsive.css        # Mobile responsiveness
├── js/
│   ├── main.js              # Main JavaScript functionality
│   └── carousel.js          # Enhanced carousel features
├── images/
│   ├── logo/                # USPS logos (SVG)
│   ├── hero/                # Hero section images
│   ├── featured/            # Featured services images
│   └── carousel/            # Product carousel images
└── README.md                # Project documentation
```

## 🛠️ Technologies Used

- **HTML5**: Semantic markup
- **CSS3**: Custom styling with CSS Grid and Flexbox
- **Bootstrap 5.3.2**: Responsive framework
- **Bootstrap Icons**: Icon library
- **JavaScript (ES6+)**: Interactive functionality
- **SVG**: Scalable vector graphics for logos and placeholders

## 🎨 Design System

### Colors

- **Primary Blue**: `#004c97` (USPS Blue)
- **Secondary Blue**: `#0073e6` (Light Blue)
- **Accent Red**: `#cc0000` (USPS Red)
- **Gray Tones**: `#666666`, `#f8f9fa`, `#333333`

### Typography

- **Font Family**: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
- **Headings**: Bold weights with proper hierarchy
- **Body Text**: 1.6 line height for readability

### Components

- **Buttons**: Rounded corners with hover effects
- **Cards**: Subtle shadows with hover animations
- **Forms**: Clean inputs with focus states
- **Navigation**: Smooth transitions and hover states

## 📱 Responsive Breakpoints

- **Extra Small**: < 576px (Mobile)
- **Small**: ≥ 576px (Large Mobile)
- **Medium**: ≥ 768px (Tablet)
- **Large**: ≥ 992px (Desktop)
- **Extra Large**: ≥ 1400px (Large Desktop)

## ⚡ Performance Features

- **Lazy Loading**: Images load as needed
- **Optimized Animations**: Smooth 60fps animations
- **Debounced Events**: Efficient event handling
- **Compressed Assets**: Optimized file sizes
- **CDN Resources**: Fast loading of external libraries

## 🔧 Setup & Installation

1. **Clone or Download** the project files
2. **Open** `index.html` in a web browser
3. **No build process required** - ready to use!

### For Development:

```bash
# Serve locally (optional)
python -m http.server 8000
# or
npx serve .
```

## 🌐 Browser Support

- **Chrome**: 90+
- **Firefox**: 88+
- **Safari**: 14+
- **Edge**: 90+
- **Mobile Browsers**: iOS Safari 14+, Chrome Mobile 90+

## ♿ Accessibility Features

- **WCAG 2.1 AA Compliant**
- **Keyboard Navigation**: Full keyboard support
- **Screen Reader Friendly**: Proper ARIA labels
- **Focus Management**: Visible focus indicators
- **Color Contrast**: Meets accessibility standards
- **Semantic HTML**: Proper heading hierarchy

## 🎯 Key Features Breakdown

### Navigation System

- Multi-level dropdown menus
- Mobile hamburger menu
- Search functionality with suggestions
- Breadcrumb navigation (where applicable)

### Interactive Elements

- Hover effects on cards and buttons
- Smooth scrolling for anchor links
- Form validation with visual feedback
- Modal dialogs for search and other actions

### Content Sections

- Hero banner with search functionality
- Quick tools grid with icons
- Featured services showcase
- Product carousel with controls
- News/updates section
- Comprehensive footer

## 🔄 Customization

### Colors

Edit CSS custom properties in `css/style.css`:

```css
:root {
  --usps-blue: #004c97;
  --usps-red: #cc0000;
  --usps-light-blue: #0073e6;
  /* Add your custom colors */
}
```

### Content

- Update text content in `index.html`
- Replace placeholder images in `/images/` folders
- Modify navigation links and structure

### Styling

- Custom styles in `css/style.css`
- Responsive adjustments in `css/responsive.css`
- Bootstrap overrides as needed

## 📄 License

This project is for educational and demonstration purposes. The design is inspired by USPS.com but is not affiliated with or endorsed by the United States Postal Service.

## 🤝 Contributing

Feel free to submit issues and enhancement requests!

## 📞 Support

For questions or support, please refer to the documentation or create an issue in the project repository.

---

**Note**: This is a static website template inspired by USPS design. Replace placeholder content and images with your actual content before production use.
