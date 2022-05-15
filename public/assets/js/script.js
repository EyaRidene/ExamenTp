const tds=document.querySelectorAll("td")

    tds.forEach((td) =>
    td.addEventListener("click", () => {
        td.classList.toggle("highlight");
    })
);
