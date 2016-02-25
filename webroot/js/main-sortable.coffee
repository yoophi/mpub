require ["jquery", "underscore-min", "jquery-ui-1.8.23.custom.min", "jquery.mjs.nestedSortable", "json2", "jquery.jeditable"], ($) ->
  $(document).ready ->
    getTocJson = (e) ->
      arraied = $("ol.sortable").nestedSortable("toArray",
        startDepthCount: 0
      )

      #console.log(JSON.stringify(arraied));
      data = new Array()
      order = []
      _.each arraied, (element, n) ->
        return  if n is 0

        #console.log(JSON.stringify(element));
        element.id = element.item_id
        element.name = $("#list_" + element.id).attr("data-name")
        element.article_id = $("#list_" + element.id).attr("data-article_id")
        if typeof order[element.depth] is "undefined"
          order[element.depth] = 1
        else
          order[element.depth]++
        element.order = order[element.depth]

        #console.log(JSON.stringify(element));
        #console.log('-----');
        data[data.length] = element

      json_string = JSON.stringify(data)

      #$('#toArrayOutput').html(json_string);
      $("#txt-update-json").val json_string
      true

    $("#sortable").nestedSortable
      handle: "div"
      items: "li"
      protectRoot: true
      toleranceElement: "> div"

    $(".deleteme").click ->
      obj_id = $(this).attr("data-id")
      $("#list_" + obj_id).remove()

    $("#to_array").click getTocJson
    $("#UpdateJson").submit ->
      getTocJson()

    $("#add_item").click ->
      new_id = _.uniqueId() + 1000
      $("ol.sortable > li > ol").append "<li id=\"list_" + new_id + "\" data-article_id=\"0\" data-name=\"undefined\">" + "<div>" + "<span class=\"editable\" data-id=\"" + new_id + "\">new toc item (" + new_id + ")</span>" + "<a href=\"#\" class=\"deleteme\" data-id=\"" + new_id + "\">DEL</a>" + "</div>" + "</li>"
      $("#list_" + new_id).find(".editable").editable ((value, settings) ->
        id = $(this).attr("data-id")
        $("#list_" + id).attr "data-name", value
        value
      ),
        type: "text"
        submit: "OK"

      $("#list_" + new_id).find(".deleteme").click ->
        obj_id = $(this).attr("data-id")
        $("#list_" + obj_id).remove()


    $(".editable").editable ((value, settings) ->
      id = $(this).attr("data-id")
      $("#list_" + id).attr "data-name", value
      value
    ),
      type: "text"
      submit: "OK"


