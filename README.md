# Pexels Batch Image Downloader

🖼️ A web-based tool for bulk downloading high-quality landscape images from Pexels API and saving them directly to your server.

## ✨ Features

- **Batch Processing**: Download multiple images from different keywords
- **Landscape Only**: Automatically filters for landscape orientation photos
- **High Quality**: Downloads large-size images suitable for professional use
- **Server Storage**: Saves images directly to server directory
- **Custom Naming**: Auto-numbered file naming (e.g., `bangkok-01.jpg`, `bangkok-02.jpg`)
- **Real-time Progress**: Live status updates and progress tracking
- **Gallery Viewer**: Built-in image viewer to browse downloaded images

## 🚀 Quick Start

### Prerequisites

- Web server with PHP support (Apache/Nginx)
- Pexels API key (free at [pexels.com/api](https://www.pexels.com/api/))

### Installation

1. **Clone the repository**
   
   ```bash
   git clone https://github.com/yourusername/pexels-batch-downloader.git
   cd pexels-batch-downloader
   ```
1. **Setup web server**
- Place files in your web server directory
- Ensure PHP has write permissions to create `/download/` folder
1. **Get Pexels API Key**
- Visit [Pexels API](https://www.pexels.com/api/)
- Sign up for free account
- Generate your API key
1. **Configure server (optional)**
   
   ```bash
   cp .htaccess.example .htaccess
   ```
1. **Start using**
- Open `demo.html` in your browser
- Enter your Pexels API key
- Input keywords and filenames
- Click “Save Images to Server”

## 📝 Usage

### Input Format

Enter keywords and filenames in the textarea, one per line:

```
nature,mountain_landscape
ocean,blue_sea
sunset,golden_hour
city,urban_scene
travel,adventure_photo
```

### Output

Downloaded images will be saved with auto-numbered format:

```
mountain_landscape-01.jpg
mountain_landscape-02.jpg
mountain_landscape-03.jpg
blue_sea-01.jpg
blue_sea-02.jpg
...
```

### Viewing Images

Visit `view_images.php` to browse all downloaded images in a gallery format.

## ⚙️ Configuration

### File Structure

```
📁 project-root/
├── demo.html          # Main application interface
├── save_image.php     # Server-side image handler
├── view_images.php    # Image gallery viewer
├── .htaccess          # Server configuration
├── 📁 download/       # Images storage (auto-created)
│   ├── image-01.jpg
│   ├── image-02.jpg
│   └── ...
└── README.md
```

### Server Requirements

- **PHP**: 7.4+ recommended
- **Extensions**: cURL, GD, FileInfo
- **Permissions**: Write access to create directories
- **Upload Limits**: 50MB+ recommended for large images

### Rate Limits

- **Free Plan**: 200 requests/hour, 20,000 requests/month
- The tool automatically handles rate limiting with delays between requests

## 🔧 Customization

### Change File Naming Format

Edit line ~283 in `demo.html`:

```javascript
// Current: bangkok-01.jpg, bangkok-02.jpg
const downloadFilename = `${filename}-${String(j + 1).padStart(2, '0')}.jpg`;

// For 3 digits: bangkok-001.jpg, bangkok-002.jpg
const downloadFilename = `${filename}-${String(j + 1).padStart(3, '0')}.jpg`;

// For underscore: bangkok_01.jpg, bangkok_02.jpg
const downloadFilename = `${filename}_${String(j + 1).padStart(2, '0')}.jpg`;
```

### Change Storage Directory

Edit line 25 in `save_image.php`:

```php
// Current: /download/
$downloadDir = __DIR__ . '/download/';

// Custom: /images/
$downloadDir = __DIR__ . '/images/';
```

### Modify Image Quality

Edit line ~60 in JavaScript:

```javascript
// Current: Large size
photo.src.large

// Options: original, large2x, large, medium, small
photo.src.original  // Highest quality
photo.src.medium    // Smaller file size
```

## ⚠️ Important Legal Notice

### Pexels API Terms

- This tool uses the official Pexels API
- All images are subject to [Pexels License](https://www.pexels.com/license/)
- **Attribution required** for free accounts
- **Commercial use allowed** under Pexels License

### User Responsibilities

- ✅ Comply with [Pexels Terms of Service](https://www.pexels.com/terms-of-service/)
- ✅ Provide proper attribution to photographers when required
- ✅ Respect API rate limits
- ✅ Use images according to their specific licenses

### Disclaimer

This tool is provided for educational and legitimate purposes only. Users are solely responsible for:

- Obtaining proper API credentials
- Following copyright laws and licensing terms
- Ensuring compliance with applicable regulations
- Proper attribution of downloaded content

## 🛡️ Security Features

- ✅ **API Key Protection**: Never commits API keys to repository
- ✅ **Input Sanitization**: Prevents path traversal attacks
- ✅ **File Validation**: Validates file types and names
- ✅ **Directory Protection**: Secure file storage practices
- ✅ **Error Handling**: Graceful error management

## 🐛 Troubleshooting

### Common Issues

**“No images found” error:**

- Check your API key is correct
- Verify internet connection
- Try different keywords

**“Failed to save image” error:**

- Check PHP write permissions
- Verify `/download/` directory exists
- Check disk space

**Rate limit exceeded:**

- Wait before making more requests
- Consider upgrading to Pexels Pro for higher limits

**Images not displaying in gallery:**

- Check file permissions
- Verify web server can serve static files
- Check browser console for errors

### Debug Mode

Enable error reporting in `save_image.php`:

```php
// Add at top of file for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

## 🤝 Contributing

Contributions are welcome! Please read our contributing guidelines:

1. Fork the repository
1. Create a feature branch (`git checkout -b feature/amazing-feature`)
1. Commit your changes (`git commit -m 'Add amazing feature'`)
1. Push to the branch (`git push origin feature/amazing-feature`)
1. Open a Pull Request

### Development Setup

```bash
# Clone your fork
git clone https://github.com/yourusername/pexels-batch-downloader.git

# Setup local development server
php -S localhost:8000

# Visit http://localhost:8000/demo.html
```

## 📄 License

This project is licensed under the MIT License - see the <LICENSE> file for details.

## 🙏 Acknowledgments

- **Pexels** for providing the amazing free API and high-quality images
- **Photographers** who contribute their beautiful work to Pexels
- **Open Source Community** for tools and libraries used

## 📞 Support

- 🐛 **Bug Reports**: [GitHub Issues](https://github.com/yourusername/pexels-batch-downloader/issues)
- 💡 **Feature Requests**: [GitHub Discussions](https://github.com/yourusername/pexels-batch-downloader/discussions)
- 📖 **Documentation**: [Wiki](https://github.com/yourusername/pexels-batch-downloader/wiki)

## 🔗 Related Projects

- [Pexels Official API Documentation](https://www.pexels.com/api/documentation/)
- [Similar Tools and Alternatives](https://github.com/topics/pexels-api)

-----

**⭐ If this tool helped you, please consider starring the repository!**

Made with ❤️ for the developer community
