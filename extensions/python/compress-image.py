from PIL import Image

file = '_{{file}}_'
newFile = '_{{newFile}}_'
quality = '_{{quality}}_'
# check if quality contains "{"
if '{' in quality:
     quality = 40

picture = Image.open(file)

try:
    picture.save(newFile, format="WebP", optimize=True, quality=quality)
except:
    print("Unable to process image")
