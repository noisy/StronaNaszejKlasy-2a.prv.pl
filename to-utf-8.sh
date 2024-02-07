#!/bin/bash

# Find files containing "iso-8859-2" or "ISO-8859-2"
find . -type f \( -iname "*.html" -o -iname "*.css" -o -iname "*.js" -o -iname "*.php" -o -iname "*.txt" \) ! -path "*/.git/*" | while read -r file; do
    grep -iq "iso-8859-2" "$file"
    if [ $? -eq 0 ]; then
        echo "Converting $file"
        # Convert the file encoding from ISO-8859-2 to UTF-8
        iconv -f ISO-8859-2 -t UTF-8 "$file" > "$file.tmp" && mv "$file.tmp" "$file"
    fi
done
