package utils

import (
	"bytes"
	"fmt"
	"html/template"
	"log"
)

func PrepareTemplate(templateName string, data interface{}) string {
	var err error

	t, err := template.ParseFiles(fmt.Sprintf("templates/%s.html", templateName))
	if err != nil {
		log.Println(err)
	}

	var tpl bytes.Buffer
	if err := t.Execute(&tpl, data); err != nil {
		log.Println(err)
	}
	return tpl.String()
}
