import $ from 'jquery';
import {parse_json} from './parse_json';
import {Stars} from "./Stars";
export const MovieInfo = function(sel) {
    this.sel = sel;
    var that = this;
    var obj = $(sel);
    if(obj.length === 0) {
        return;
    }

    var element = obj.get(0);

    var title = element.dataset.movie;
    var year = element.dataset.year;

    console.log(title);
    console.log(year);

    $.ajax({
        url: "https://api.themoviedb.org/3/search/movie",
        data: {api_key: "e33e58ed39fef4ba553509749d2deadb", query: title, year: year},
        method: "GET",
        dataType: "text",
        success: function(data) {
            console.log("Here");
            console.log(data);
            var json = parse_json(data);
            console.log(json);
            if(json.total_results) {
                // Successful
                console.log("MovieInfo Success");
                var html = '';
                console.log(json);
                html += that.info(json);
                html += that.plot(json);
                if(json.results[0].poster_path !== null) {
                    html += that.poster(json);
                }
                that.displayMovieInfo(html);
            } else {
                // Failed
                console.log("MovieInfo Failure");
                $(that.sel).html("<p>No information available</p>");
            }
        },
        error: function(xhr, status, error) {
            // Error
            console.log("MovieInfo Error");
            $(that.sel).html("<p>Unable to communicate<br>with themoviedb.org</p>");
        }
    });
}

// Functions for the movie info tabs
MovieInfo.prototype.info = function (json) {
    var that = this;
    var result = '<li><a href=""><img src="src/img/info.png"></a><div>';

    result += '<p>Title: ' + json.results[0].title + '</p>';
    result += '<p>Release Date: ' + json.results[0].release_date + '</p>';
    result += '<p>Vote average: ' + json.results[0].vote_average + '</p>';
    result += '<p>Vote count: ' + json.results[0].vote_count + '</p>';

    result += '</div></li>';
    return result;
};

MovieInfo.prototype.plot = function (json) {
    var that = this;
    var result = '<li><a href=""><img src="src/img/plot.png"></a><div>';

    result += '<p>' + json.results[0].overview + '</p>';

    result += '</div></li>';
    return result;

};

MovieInfo.prototype.poster = function (json) {
    var that = this;
    var result = '<li><a href=""><img src="src/img/poster.png"></a><div>';

    result += '<p class="poster"><img src="http://image.tmdb.org/t/p/w500' + json.results[0].poster_path + '">';

    result += '</div></li>';
    return result;

};

MovieInfo.prototype.displayMovieInfo = function (html) {
    var final_html = "<ul>" + html + "</ul>";
    $(this.sel).html(final_html);
    var info = $("ul > li:first-child");
    info.children("div").show();
    info.children("a").children().css("opacity", "1");


    $("ul > li > a").click(function (event) {
        event.preventDefault();
        console.log("tag clicked");
        // Unselected tab
        $(this).parent().siblings().children("div").fadeOut(750);
        $(this).parent().siblings().children("a").children().css("opacity", "0.3");
        // Selected tab
        $(this).parent().children("div").fadeIn(750);
        $(this).parent().children("a").children().css("opacity", "1");
    });
};