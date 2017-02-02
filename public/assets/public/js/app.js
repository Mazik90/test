'use strict';

(function ($) {
    var BaseDir   = '/';

    var routes = [],
        params = {},
        pages = {
            todoList: function () {
                deleteTodo();
            },
            todoEdit: function () {
                editTodo();
            }
        };

    function url(url){
        return BaseDir + url;
    }


    function route(route, action) {
        routes.push({route: route, action: action});
    }

    function runRoute() {
        var locationArray = window.location.pathname.split('/'),
            errorRoute = false;

        params = {};

        var exp = /{([a-z0-9]+)}/i;

        for (var i = 0; i < routes.length; i++){
            var routeUrl = url(routes[i]['route']).split('/');
            if(routeUrl.length != locationArray.length){
                continue;
            }
            for(var j = 0; j < locationArray.length; j++){
                errorRoute = false;
                if(exp.test(routeUrl[j])){
                    var index = routeUrl[j].match(exp);
                    params[index[1]] = locationArray[j];
                    continue;
                }

                if(routeUrl[j] != locationArray[j]){
                    errorRoute = true;
                    break;
                }
            }

            if(pages[routes[i]['action']] != undefined && !errorRoute){
                pages[routes[i]['action']]();
                history.replaceState({ action: routes[i]['action']}, '');
                break;
            }
        }
    }

    function editTodo() {
        var $mainContainer   = $('section.todoapp'),
            $newTodoControl  = $mainContainer.find('.new-todo'),
            $todoList        = $mainContainer.find('.todo-list'),
            $footer          = $mainContainer.find('footer.footer'),
            $main            = $mainContainer.find('section.main'),
            $filters         = $mainContainer.find('ul.filters'),
            $todoCount       = $mainContainer.find('.todo-count'),
            $clearCompleted  = $mainContainer.find('.clear-completed'),
            newTodoFocusFlag = true,
            objectData       = {
                id: document.getElementById('current-todo').value,
                value: []
            };

        filter();
        searchToData();
        updateInfo();

        function searchToData() {
            objectData.value = [];
            $todoList.find('li').each(function (index, value) {
                var $value = $(value);
                objectData.value.push({checked: $value.hasClass('completed'), value: $value.find('input.edit').val()});
            });

            $.each([$footer, $main], function (index, $value) {
                if (objectData.value.length == 0) {
                    $value.css('display', 'none');
                } else {
                    $value.css('display', 'block');
                }
            });
        }

        function filter(hash) {
            if (hash != undefined) {
                window.location.hash = hash;
            }

            $todoList.find('li').removeClass('hidden');
            $filters.find('a[href="' + window.location.hash + '"]').addClass('selected');

            if (window.location.hash == '' || window.location.hash == '#/') {
                $filters.find('a[href="#/"]').addClass('selected');
            } else if (window.location.hash == '#/active') {
                $todoList.find('li input.toggle').each(function (index, value) {
                    if (value.checked) {
                        $(value).parents('li').addClass('hidden');
                    }
                })
            } else if (window.location.hash == '#/completed') {
                $todoList.find('li input.toggle').each(function (index, value) {
                    if (!value.checked) {
                        $(value).parents('li').addClass('hidden');
                    }
                })
            }
        }

        function updateInfo() {
            var countCheck = 0;
            $.each(objectData.value, function (index, value) {
                if (!value.checked) {
                    countCheck++;
                }
            });
            $todoCount.html('<strong>' + countCheck + '</strong> ' + (countCheck > 1 ? 'items' : 'item') + ' left');

            if (countCheck != objectData.value.length) {
                $clearCompleted.css('display', 'block');
            } else {
                $clearCompleted.css('display', 'none');
            }
        }

        function getTemplate(text, check) {
            return '<li ' + (check ? 'class="completed"' : null) + '>' +
                '<div class="view">' +
                    '<input class="toggle" type="checkbox" ' + (check ? 'checked' : null) + '>' +
                    '<label>' + text + '</label>' +
                    '<button class="destroy"></button>' +
                '</div>' +
                '<input class="edit" value="' + text + '">' +
            '</li>';
        }

        function addLi(text) {
            var liTemplate = getTemplate(text, false);

            $todoList.append(liTemplate);
            objectData.value.push({checked: false, value: text});

            $.each([$footer, $main], function (index, $value) {
                $value.css('display', 'block');
            });

            filter();
            updateLi();
        }

        function updateLi() {
            updateInfo();
            $.post(url('ajax/todo/update'), {id: objectData.id, value: JSON.stringify(objectData.value)}, null, 'json');
        }

        $mainContainer.find('input.toggle-all').on('click', function (e) {
            var checked = this.checked;
            $todoList.find('li input.toggle').each(function (index, value) {
                value.checked = checked;
                $(value).trigger('change');
            })
        });

        var timeOut;
        $todoList.on('change', 'li input.toggle', function (e) {
            var $element = $(this),
                $parentLi = $element.parents('li');

            if (this.checked) {
                $parentLi.addClass('completed');
            } else {
                $parentLi.removeClass('completed');
            }

            filter();
            searchToData();

            clearTimeout(timeOut);
            timeOut = setTimeout(function () {
                updateLi();
            }, 50);
        });

        $todoList.on('click', 'li button.destroy', function () {
            $(this).parents('li').remove();
            searchToData();

            clearTimeout(timeOut);
            timeOut = setTimeout(function () {
                updateLi();
            }, 50);
        });

        $newTodoControl.on('focus', function () {
            newTodoFocusFlag = true;
        });

        $newTodoControl.on('focusout', function () {
            newTodoFocusFlag = false;
        });

        $newTodoControl.on('keyup', function (e) {
           if (newTodoFocusFlag && e.keyCode == 13) {
               addLi(this.value);
               this.value = '';
           }
        });

        $filters.find('a').on('click', function (e) {
            $filters.find('a').removeClass('selected');
            var $element = $(this);
            $element.addClass('selected');

            filter($element.attr('href'));
        });

        $clearCompleted.on('click', function () {
            $todoList.find('li.completed button.destroy').trigger('click');
        });

        $todoList.on('keyup', 'li input.edit', function (e) {
            if (e.keyCode == 13) {
                var $element = $(this);

                $todoList.find('li').removeClass('editing');
                $element.parents('li').find('label').text($element.val());

                searchToData();
                updateLi();
            }
        });

        var editor = false;
        $todoList.on('dblclick', 'li label', function () {
            editor = true;
            $(this).parents('li').addClass('editing');
        });

        $todoList.find('li input.edit').on('keyup', function (e) {
            if (newTodoFocusFlag && e.keyCode == 13) {
                searchToData();
                updateLi();
            }
        });

        $(document).click('click', function (e) {
            if (editor && !$(e.target).hasClass('edit')) {
                $todoList.find('li.editing label').text($todoList.find('li.editing input.edit').val());
                $todoList.find('li').removeClass('editing');

                searchToData();
                updateLi();

                editor = false;
            }
        });
    }

    function deleteTodo() {
        $('tbody button.delete').on('click', function () {
            var $element = $(this),
                $parentTr = $element.parents('tr');

            $parentTr.css('display', 'none');

            $.post(url('ajax/todo/delete'), {id: $element.data('id')}, function () {
                $parentTr.remove();
            }, 'json').fail(function(){
                $parentTr.css('display', 'table-row');
            });
        });
    }

    $(document).ready(function(){

        //routes
        route('edit', 'todoEdit');
        route('', 'todoList');
        //end routes

        runRoute();
    });
})(jQuery);
