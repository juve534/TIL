package main

import (
	"fmt"
	"html"
	"log"
	"net/http"
)

func main() {

	http.HandleFunc("/bar", bar)

	log.Fatal(http.ListenAndServe(":8080", nil))
}

func bar(w http.ResponseWriter, r *http.Request) {
	w.WriteHeader(http.StatusOK)
	w.Write([]byte(fmt.Sprintf("Hello, %q", html.EscapeString(r.URL.Path))))
}
