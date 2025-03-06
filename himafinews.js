// Contoh data berita yang di-upload
const news = [
    { title: "Berita 1", link: "../HIMAFINews/Berita1.html" },
    { title: "Berita 2", link: "https://example.com/berita2" },
    { title: "Berita 3", link: "https://example.com/berita3" },
    { title: "Berita 4", link: "https://example.com/berita4" }
];

// Fungsi untuk menampilkan berita dalam bentuk list dengan tampilan lebih menarik
function displayNews(news) {
    const newsUl = document.getElementById('news-ul');
    newsUl.innerHTML = ''; // Clear the list before adding

    news.forEach(article => {
        const li = document.createElement('li');
        li.style.padding = "10px";
        li.style.margin = "10px 0";
        li.style.border = "1px solid #ccc";
        li.style.borderRadius = "5px";
        li.style.backgroundColor = "#f9f9f9";
        li.style.listStyle = "none";
        li.style.textAlign = "center";
        
        const a = document.createElement('a');
        a.href = article.link;
        a.target = "_blank";
        a.textContent = article.title;
        a.style.textDecoration = "none";
        a.style.color = "#333";
        a.style.fontWeight = "bold";
        a.style.padding = "5px 10px";
        a.style.display = "inline-block";
        a.style.transition = "background-color 0.3s, color 0.3s";
        
        // Tambahkan efek hover
        a.onmouseover = () => {
            a.style.backgroundColor = "#333";
            a.style.color = "#fff";
            a.style.borderRadius = "5px";
        };
        a.onmouseout = () => {
            a.style.backgroundColor = "transparent";
            a.style.color = "#333";
        };
        
        li.appendChild(a);
        newsUl.appendChild(li);
    });
}

// Fungsi untuk mencari berita berdasarkan input
function searchNews() {
    const searchInput = document.getElementById('search-input').value.toLowerCase();
    const filteredNews = news.filter(article => 
        article.title.toLowerCase().includes(searchInput)
    );
    displayNews(filteredNews);
}

// Event listener untuk pencarian
document.getElementById('search-input').addEventListener('input', searchNews);

// Menampilkan semua berita saat pertama kali halaman dimuat
window.onload = () => displayNews(news);
