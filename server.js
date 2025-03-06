import express from 'express';
import path from 'path';
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));

const app = express();
const port = process.env.PORT || 3000;

app.set('view engine', 'ejs'); // Додаємо цей рядок для налаштування EJS
app.set('views', path.join(__dirname, 'views'));

app.use(express.urlencoded({ extended: true }));
// app.use(express.static('public'));
app.use(express.static(path.join(__dirname, 'public')));


// app.get('/', (req, res) => {
//     res.sendFile(path.join(__dirname, '/public/index.html'));
// });

app.get("/", (req, res) => {
    res.render("index.ejs", { page: 'home' });
});


app.get("/about", (req, res) => {
    res.render("about.ejs", { page: 'about' });
});


app.get("/contact", (req, res) => {
    res.render("contact.ejs", { page: 'contact' });
});

app.post("/contact", (req, res) => {
    const { name, email, text } = req.body;
    console.log(`Name: ${name}, Email: ${email}, Comment: ${text}`);
    res.redirect("/contact-success");
});

app.get("/contact-success", (req, res) => {
    res.render("contact-success.ejs", { page: 'contact-success' });
});

app.get("/ajax-get", (req, res) => {
    res.json({ 
        message: "This is a response from AJAX GET request",
        timestamp: new Date().toLocaleString()
    });
});

app.post("/ajax-post", (req, res) => {
    const { email, password } = req.body;
    res.json({ 
        message: `Received POST data - Email: ${email}, Password: ${password}`,
        timestamp: new Date().toLocaleString()
    });
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});

// module.exports = app;
export default app;