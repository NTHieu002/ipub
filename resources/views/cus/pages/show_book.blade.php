@extends('layouts.app')

@section('content')
    <div class="hero page-inner overlay" id="cover">

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 id="title" class="heading" data-aos="fade-up"></h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item "><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item "><a href="properties.html" id="author"></a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">{{ $book->book_desc }}</li>
                        </ol>
                    </nav>


                </div>
            </div>


        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="img-property-slide-wrap img-property-slide-wrap-cover">
                            <div class="img-property-slide">
                                <img id="img-cover" alt="Image" class="img-fluid">
                            </div>
                        </div>
                        <div id="navigation">
                            {{-- <h1 id="title"></h1>
                            <image id="cover" width="150px"/>
                            <h2 id="author"></h2> --}}
                            <div id="toc"></div>
                        </div>
                        
                    </div>
                    <div id="frame" class="col-lg-9">
                        
                        <div id="viewer">
    
                        </div>
                        <div id="pagination">
                          <a id="prev" href="#prev" class="arrow">Prev</a>
                          <a id="next" href="#next" class="arrow">Next</a>
                        </div>
                    </div>
                    <div id="extras" class="col-lg-9">
                        <ul id="highlights"></ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    {{-- <script type="text/javascript">
        var book = ePub('../public/uploads/books/{{ $book->book }}');

        var cover = document.getElementById("cover");
        var img_cover = document.getElementById("img-cover");
        book.coverUrl().then(function(url_img) {
            cover.style.backgroundImage = 'url(' + url_img + ')';
            img_cover.src = url_img;
        })
        var title = document.getElementById("title");
        var author = document.getElementById("author");
        book.loaded.metadata.then(function(meta) {
            title.textContent = meta.title;
            author.textContent = meta.creator;
        })



        // read
        var rendition = book.renderTo("viewer", {
            width: "100%",
            height: "100%",
            flow: "scrolled-doc"
            // flow: "scrolled-doc"
        });
        var hash = window.location.hash.slice(2);
        console.log(hash);
        rendition.display(hash || undefined);


        var next = document.getElementById("next");
        next.addEventListener("click", function(e) {
            rendition.next();
            e.preventDefault();
        }, false);

        var prev = document.getElementById("prev");
        prev.addEventListener("click", function(e) {
            rendition.prev();
            e.preventDefault();
        }, false);

        rendition.on("rendered", function(section) {
            var nextSection = section.next();
            var prevSection = section.prev();

            if (nextSection) {
                nextNav = book.navigation.get(nextSection.href);

                if (nextNav) {
                    nextLabel = nextNav.label;
                } else {
                    nextLabel = "next";
                }

                next.textContent = nextLabel + " »";
            } else {
                next.textContent = "";
            }

            if (prevSection) {
                prevNav = book.navigation.get(prevSection.href);

                if (prevNav) {
                    prevLabel = prevNav.label;
                } else {
                    prevLabel = "previous";
                }

                prev.textContent = "« " + prevLabel;
            } else {
                prev.textContent = "";
            }

            // Add CFI fragment to the history
            history.pushState({}, '', section.href);
            window.location.hash = "#/" + section.href
        });

        rendition.on("relocated", function(location) {
            console.log('hi',location);
        });

        book.loaded.navigation.then(function(toc) {
            var $nav = document.getElementById("toc"),
                docfrag = document.createDocumentFragment();
            var addTocItems = function(parent, tocItems) {
                var $ul = document.createElement("ul");
                tocItems.forEach(function(chapter) {
                    var item = document.createElement("li");
                    var link = document.createElement("a");
                    link.textContent = chapter.label;
                    link.href = chapter.href;
                    item.appendChild(link);

                    if (chapter.subitems) {
                        addTocItems(item, chapter.subitems)
                    }

                    link.onclick = function() {
                        var url = link.getAttribute("href");
                        rendition.display(url);
                        return false;
                    };

                    $ul.appendChild(item);
                });
                parent.appendChild($ul);
            };

            addTocItems(docfrag, toc);

            $nav.appendChild(docfrag);

            if ($nav.offsetHeight + 60 < window.innerHeight) {
                $nav.classList.add("fixed");
            }

        });
    </script> --}}

    <script>
        // Load the opf
        var book = ePub('../public/uploads/books/{{ $book->book }}');

        var cover = document.getElementById("cover");
        var img_cover = document.getElementById("img-cover");
        book.coverUrl().then(function(url_img) {
            cover.style.backgroundImage = 'url(' + url_img + ')';
            img_cover.src = url_img;
        })
        var title = document.getElementById("title");
        var author = document.getElementById("author");
        book.loaded.metadata.then(function(meta) {
            title.textContent = meta.title;
            author.textContent = meta.creator;
        })
    
        var rendition = book.renderTo("viewer", {
          width: "100%",
          height: 620,
          ignoreClass: 'annotator-hl',
           manager: "continuous",
        //   flow: "scrolled-doc"
        });
    
        var displayed = rendition.display();
    
        // Navigation loaded
        // book.loaded.navigation.then(function(toc){
        //   console.log('toc',toc);
        // });
        book.loaded.navigation.then(function(toc) {
            var $nav = document.getElementById("toc"),
                docfrag = document.createDocumentFragment();
            var addTocItems = function(parent, tocItems) {
                var $ul = document.createElement("ul");
                tocItems.forEach(function(chapter) {
                    var item = document.createElement("li");
                    var link = document.createElement("a");
                    link.textContent = chapter.label;
                    link.href = chapter.href;
                    item.appendChild(link);

                    if (chapter.subitems) {
                        addTocItems(item, chapter.subitems)
                    }

                    link.onclick = function() {
                        var url = link.getAttribute("href");
                        rendition.display(url);
                        return false;
                    };

                    $ul.appendChild(item);
                });
                parent.appendChild($ul);
            };

            addTocItems(docfrag, toc);

            $nav.appendChild(docfrag);

            if ($nav.offsetHeight + 60 < window.innerHeight) {
                $nav.classList.add("fixed");
            }

        });
    
        var next = document.getElementById("next");
        next.addEventListener("click", function(){
          rendition.next();
        }, false);
    
        var prev = document.getElementById("prev");
        prev.addEventListener("click", function(){
          rendition.prev();
        }, false);
    
        var keyListener = function(e){
    
          // Left Key
          if ((e.keyCode || e.which) == 37) {
            rendition.prev();
          }
    
          // Right Key
          if ((e.keyCode || e.which) == 39) {
            rendition.next();
          }
    
        };
    
        rendition.on("keyup", keyListener);
        document.addEventListener("keyup", keyListener, false);
    
        rendition.on("relocated", function(location){
          // console.log(location);
        });
    
    
        // Apply a class to selected text
        rendition.on("selected", function(cfiRange, contents) {
          rendition.annotations.highlight(cfiRange, {}, (e) => {
            console.log("highlight clicked", e.target);
          });
          contents.window.getSelection().removeAllRanges();
    
        });
    
        this.rendition.themes.default({
          '::selection': {
            'background': 'rgba(255,255,0, 0.3)'
          },
          '.epubjs-hl' : {
            'fill': 'yellow', 'fill-opacity': '0.3', 'mix-blend-mode': 'multiply'
          }
        });
    
        // Illustration of how to get text from a saved cfiRange
        var highlights = document.getElementById('highlights');
    
        rendition.on("selected", function(cfiRange) {
    
          book.getRange(cfiRange).then(function (range) {
            var text;
            var li = document.createElement('li');
            var a = document.createElement('a');
            var remove = document.createElement('a');
            var textNode;
    
            if (range) {
              text = range.toString();
              textNode = document.createTextNode(text);
    
              a.textContent = cfiRange;
              a.href = "#" + cfiRange;
              a.onclick = function () {
                rendition.display(cfiRange);
              };
    
              remove.textContent = "remove";
              remove.href = "#" + cfiRange;
              remove.onclick = function () {
                rendition.annotations.remove(cfiRange);
                return false;
              };
    
              li.appendChild(a);
              li.appendChild(textNode);
              li.appendChild(remove);
              highlights.appendChild(li);
            }
    
          })
    
        });
    
      </script>
@endsection
