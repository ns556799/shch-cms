<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{#shortcodes_dlg.title}</title>
    <script type="text/javascript" src="../../../framework/thirdparty/tinymce/tiny_mce_popup.js"></script>
    <%-- script type="text/javascript" src="/mysite/javascript/shortcodes/js/dialog.js"></script --%>

    <style type="text/css">
        .shortcode-form p {
            margin-bottom: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #999;
            font-weight: bold;
        }
        .shortcode-form ul {
            margin: 0;
            padding: 0;
        }
        .shortcode-form ul li {
            display: block;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #999;
        }
        .shortcode-form ul li label {
            display: inline-block;
            width: 23%;
            margin-right: 6%;
        }
        .shortcode-form ul li input,
        .shortcode-form ul li textarea {
            display: inline-block;
            width: 40%;
            padding: 2px;
            background-color: #fcfafa;
        }
        .shortcode-form ul li select {
            display: inline-block;
            width: 40%;
            padding: 2px;
            background-color: #fcfafa;
        }
    </style>
</head>
<body>

<script type="text/javascript">

    tinyMCEPopup.requireLangPack();

    var site = {};
    var InsertShortcode = {
        init : function() {
            // class helpers
            var setClasses = function(el, type) {
                for (var i = 0; i < el.length; ++i) {
                    el[i].style.display = type;
                }
            };

            // get form vars
            site.form = document.forms[0];
            site.forms = site.form.querySelectorAll('.shortcode__item:not(.-excluded)');
            site.shortcode__type = document.forms[0].shortcode__type;
            site.shortcode__typeVal = null;
            site.result;

            // Get the selected contents as text and place it in the input
            site.form.button__text.value = tinyMCEPopup.editor.selection.getContent({format : 'text'});

            //Get newsletter snippet options and populate the dropdown
            <% if $Newsletters %>
                <% loop $Newsletters %>
                    var option = document.createElement("option");
                    option.text = "$Title";
                    option.value = "$ID";
                    site.form.newsletter__id.add(option);
                <% end_loop %>
            <% end_if %>

            //Get social snippet options and add the checkboxes
            <% if $Socials %>
                var socialscontainer = site.form.querySelector('.shortcode__item.-socials-id');
                <% loop $Socials %>
                    var checkbox = document.createElement('input');
                    checkbox.type = "checkbox";
                    checkbox.name = "chk_socials[]";
                    checkbox.value = "$Title";
                    checkbox.id = "chk_$ID";

                    var label = document.createElement('label')
                    label.htmlFor = "chk_$ID";
                    label.appendChild(document.createTextNode('$Title'));

                    socialscontainer.appendChild(checkbox);
                    socialscontainer.appendChild(label);

                <% end_loop %>
            <% end_if %>

            // set display of forms depending on shortcodeType
            site.shortcode__type.addEventListener('change', function() {
                site.shortcode__typeVal = this.value;
                setClasses(site.forms, 'none');

                if (site.shortcode__typeVal === 'button') {
                    setClasses(document.querySelectorAll('.shortcode__item.-btn'), 'block');
                }else if (site.shortcode__typeVal === 'newsletter') {
                    setClasses(document.querySelectorAll('.shortcode__item.-newsletter'), 'block');
                }else if (site.shortcode__typeVal === 'socials') {
                    setClasses(document.querySelectorAll('.shortcode__item.-socials'), 'block');
                }
            });
        },

        insert : function() {
            // return if shortCode type is not selected
            if (!site.shortcode__typeVal) {
                alert("Please select the shortcode type");
                return;
            }

            // if button...
            if (site.shortcode__typeVal === 'button') {
                var btnTextVal = site.form.button__text.value || '';
                var btnActionVal = site.form.button__action.value || '';
                var btnStyleVal = site.form.button__style.value || '';
                var btnSizeVal = site.form.button__size.value || '';

                site.result =
                        '[button ' +
                        'size="'+btnSizeVal+'" ' +
                        'style="'+btnStyleVal+'" ' +
                        'action="'+btnActionVal+'" ' +
                        'text="'+btnTextVal+'" ' +
                        ']';
            }else if (site.shortcode__typeVal === 'newsletter') {
                var newsletterIdVal = site.form.newsletter__id.value || '';

                site.result =
                        '[newsletter ' +
                        'id="'+newsletterIdVal+'" ' +
                        ']';
            }else if (site.shortcode__typeVal === 'socials') {
                //var btnSizeVal = site.form.button__size.value || '';

                //site.form.querySelectorAll('.shortcode__item:not(.-excluded)')
                //get all the checkboxes with this name and put into a comma separated list
                //chk_socials[]
                var socialschecked = site.form.querySelectorAll('input[name="chk_socials[]"]:checked'); //:checked
                var socialsvalues = [];
                for(var x = 0, l = socialschecked.length; x < l;  x++){
                    socialsvalues.push(socialschecked[x].value);
                }

                var socialscsv = socialsvalues.join(', ');

                //alert(socialschecked.length);
                site.result =
                        '[socials ' +
                        'links="'+socialscsv+'" ' +
                        ']';
            }

            // Insert the contents from the input into the document
            tinyMCEPopup.editor.execCommand('mceInsertContent', false, site.result);
            tinyMCEPopup.close();
        }
    };

    tinyMCEPopup.onInit.add(InsertShortcode.init, InsertShortcode);


</script>


<form class="shortcode-form" onsubmit="InsertShortcode.insert();return false;" action="#">
    <p> Choose shortcode type and options.</p>
    <ul>
        <!-- [select type] -->
        <li class="shortcode__item -type -excluded">
            <label>Shortcode type</label>
            <select name="shortcode__type">
                <option value="">Select...</option>
                <option value="button">Button</option>
                <option value="newsletter">Newsletter</option>
                <option value="socials">Social links</option>
            </select>
        </li>

        <!-- [button form] -->
        <li class="shortcode__item -btn -btn-style" style="display: none;">
            <label>Button style/colour</label>
            <select name="button__style">
                <option value="">Select...</option>
                <option value="dark">Dark</option>
                <option value="light">Light</option>
            </select>
        </li>
        <li class="shortcode__item -btn -btn-size" style="display: none;">
            <label>Button size</label>
            <select name="button__size">
                <option value="">Select...</option>
                <option value="fullwidth">Full width</option>
            </select>
        </li>
        <li class="shortcode__item -btn -btn-action" style="display: none;">
            <label>Button action (limited functionality)</label>
            <select name="button__action">
                <option value="">Select...</option>
                <option value="closeblock">Close panel on click</option>
            </select>
        </li>
        <li class="shortcode__item -btn -btn-text" style="display: none;">
            <label>Button text</label><input name="button__text" type="text" />
        </li>

        <!-- [newsletter form] -->
        <li class="shortcode__item -newsletter -newsletter-id" style="display: none;">
            <label>Select newsletter</label>
            <select name="newsletter__id">
                <option value="">Select...</option>
            </select>
        </li>

        <!-- [socials form] -->
        <li class="shortcode__item -socials -socials-id" name="socials__id" style="display: none;">
            <%-- label>Select social icons</label --%>
        </li>

    </ul>

    <!-- [actions] -->
    <div class="mceActionPanel">
        <input type="button" id="insert" name="insert" value="{#insert}" onclick="InsertShortcode.insert();" />
        <input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" />
    </div>


</form>

</body>
</html>
