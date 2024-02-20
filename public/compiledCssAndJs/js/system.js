/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/asset/system/js/admin.js":
/*!********************************************!*\
  !*** ./resources/asset/system/js/admin.js ***!
  \********************************************/
/***/ (() => {

$(document).ready(function () {
  adminPassword.init();
});
var adminPassword = function () {
  var $radioInput = $('input[type="radio"][name="set_password_status"]');
  var $checkedRadioInput = $('input[type="radio"][name="set_password_status"]:checked');
  var $passwordInputWrapper = $('#password-inputs');
  var init = function init() {
    togglePasswordInputs($checkedRadioInput);
    registerEvents();
  };
  var registerEvents = function registerEvents() {
    $radioInput.on('change', handleInputChange);
  };
  var handleInputChange = function handleInputChange() {
    togglePasswordInputs($(this));
  };
  var togglePasswordInputs = function togglePasswordInputs(input) {
    var displayInputs = !!parseInt(input.val());
    displayInputs ? $passwordInputWrapper.removeClass('d-none') : $passwordInputWrapper.addClass('d-none');
  };
  return {
    init: init
  };
}();

/***/ }),

/***/ "./resources/asset/system/js/backend.js":
/*!**********************************************!*\
  !*** ./resources/asset/system/js/backend.js ***!
  \**********************************************/
/***/ (() => {

$(document).ready(function () {
  sidebar.init();
  confirmDelete.init();
  confirmDeactivate.init();
  fileInput.init();
});
var sidebar = function () {
  var init = function init() {
    highlightModule();
  };
  var highlightModule = function highlightModule() {
    var $navSidebar = $('.sidebar-main');
    var path = window.location.pathname.split('/');
    var lastSegment = path[path.length - 1];
    if (lastSegment == 'create') {
      path = path[path.length - 2];
    } else if (lastSegment == 'edit') {
      path = path[path.length - 3];
    } else {
      path = lastSegment;
    }
    console.log($navSidebar.find("a[href$='" + path + "']").closest('li').children());
    if (path !== undefined) {
      $navSidebar.find("a[href$='" + path + "']").closest('li').children().addClass('active');
      $navSidebar.find("a[href$='" + path + "']").closest('li').addClass('active');
      $navSidebar.find("a[href$='" + path + "']").parents().eq(2).addClass('active');
      $navSidebar.find("a[href$='" + path + "']").parents().eq(1).css('display', 'block');
      $("li.sidebar-list.active .according-menu .fa-angle-right").removeClass('fa-angle-right');
      $("li.sidebar-list.active .according-menu .fa").addClass('fa-angle-down');
    }
  };
  return {
    init: init
  };
}();
var confirmDelete = function () {
  var $modal = $('#confirmDeleteModal');
  var $deleteBtn = $('.btn-delete');
  var $deleteForm = $modal.find('form');
  var init = function init() {
    attachEventListeners();
  };
  var attachEventListeners = function attachEventListeners() {
    $deleteBtn.on('click', handleDeleteBtnClick);
    $modal.on('hidden.bs.modal', handleModalHidden);
  };
  var handleDeleteBtnClick = function handleDeleteBtnClick() {
    var url = $(this).data('href');
    setDeleteUrl("".concat(url, "?_method=DELETE"));
  };
  var handleModalHidden = function handleModalHidden() {
    setDeleteUrl('');
  };
  var setDeleteUrl = function setDeleteUrl(url) {
    $deleteForm.attr('action', url);
  };
  return {
    init: init
  };
}();
var confirmDeactivate = function () {
  var $modal = $('#confirmDeactivateModal');
  var $deleteBtn = $('.btn-delete');
  var $deleteForm = $modal.find('form');
  var init = function init() {
    attachEventListeners();
  };
  var attachEventListeners = function attachEventListeners() {
    $deleteBtn.on('click', handleDeleteBtnClick);
    $modal.on('hidden.bs.modal', handleModalHidden);
  };
  var handleDeleteBtnClick = function handleDeleteBtnClick() {
    var url = $(this).data('href');
    setDeleteUrl("".concat(url, "?_method=DELETE"));
  };
  var handleModalHidden = function handleModalHidden() {
    setDeleteUrl('');
  };
  var setDeleteUrl = function setDeleteUrl(url) {
    $deleteForm.attr('action', url);
  };
  return {
    init: init
  };
}();
var fileInput = function () {
  var init = function init() {
    $(document).on('change', '.custom-file-input', function () {
      var files = [];
      for (var i = 0; i < $(this)[0].files.length; i++) {
        files.push($(this)[0].files[i].name);
      }
      $(this).next('.custom-file-label').html(files.join(', '));
    });
  };
  return {
    init: init
  };
}();

/***/ }),

/***/ "./resources/asset/system/js/config.js":
/*!*********************************************!*\
  !*** ./resources/asset/system/js/config.js ***!
  \*********************************************/
/***/ (() => {

$(document).ready(function () {
  cmsConfig.init();
});
var cmsConfig = function () {
  var $typeSelector = $('select#type');
  var $fieldWrapper = $('#dynamic-field-wrapper');
  var htmlContents = {};
  var init = function init() {
    registerEventListeners();
    getHtmlContents();
    populateWrapper($typeSelector.val());
  };
  var getHtmlContents = function getHtmlContents() {
    $fieldWrapper.find('.col-auto').each(function (index, input) {
      var content = $(input);
      htmlContents[content.attr('id')] = content;
    });
    $fieldWrapper.removeClass('d-none').html('');
  };
  var registerEventListeners = function registerEventListeners() {
    $typeSelector.on('change', handleTypeChange);
  };
  var handleTypeChange = function handleTypeChange() {
    populateWrapper($(this).val());
  };
  var populateWrapper = function populateWrapper(type) {
    if (!!type) {
      console.log(htmlContents);
      $fieldWrapper.html(htmlContents["".concat(type, "-type")]);
    } else {
      $fieldWrapper.html('');
    }
  };
  return {
    init: init
  };
}();

/***/ }),

/***/ "./resources/asset/system/js/roles.js":
/*!********************************************!*\
  !*** ./resources/asset/system/js/roles.js ***!
  \********************************************/
/***/ (() => {

$(document).ready(function () {
  rolesPermissions.init();
});
var rolesPermissions = function () {
  var $moduleCheckBox = $(".module");
  var $permissionCheckBox = $(".permission");
  var init = function init() {
    registerEvents();
    handleMainModuleCheck();
  };
  var registerEvents = function registerEvents() {
    $moduleCheckBox.on('change', handleSpecificModulePermissionCheck);
    $permissionCheckBox.on('change', handleSpecificMainModuleCheck);
    $permissionCheckBox.on('click', handleViewPermissionCheck);
  };
  var handleSpecificModulePermissionCheck = function handleSpecificModulePermissionCheck() {
    var moduleValue = $(this).data('module');
    $(":checkbox[class='" + moduleValue + "-sub permission" + "']").prop("checked", this.checked);
  };
  var handleSpecificMainModuleCheck = function handleSpecificMainModuleCheck() {
    var moduleValue = $(this).data('module');
    var main = moduleValue.split('-sub');
    var checkBoxes = $(".permission[data-module='" + moduleValue + "']").length;
    var checkedCheckBoxes = $('input[type="checkbox"].' + moduleValue + ':checked').length;
    if (checkBoxes === checkedCheckBoxes) {
      $(".module[data-module='" + main[0] + "']").prop('checked', true);
    } else {
      $(".module[data-module='" + main[0] + "']").prop('checked', false);
    }
  };
  var handleViewPermissionCheck = function handleViewPermissionCheck() {
    if (this.checked) {
      var route = JSON.parse($(this).val());
      if (Array.isArray(route)) {
        route = route[0];
      }
      var keys = route.url.split('/');
      if (!(route.method === 'get' && keys.length === 1)) {
        if (keys.length > 1) {
          var selectRoute = {
            url: '/' + keys[1],
            method: 'get'
          };
          $(":checkbox[value='" + JSON.stringify(selectRoute) + "']").prop("checked", "true");
        }
        // for nested resource route
        // url = '/campaigns/:campaign_id/products'
        if (keys.length >= 5) {
          var _selectRoute = {
            url: '/' + keys[1] + '/' + keys[2] + '/' + keys[3],
            method: 'get'
          };
          $(":checkbox[value='" + JSON.stringify(_selectRoute) + "']").prop("checked", "true");
        }
      }
    }
  };
  function handleMainModuleCheck() {
    var mainPermissions = $(".module");
    for (var i = mainPermissions.length - 1; i >= 0; i--) {
      var permission = mainPermissions[i];
      var moduleName = $(permission).data("module");
      $(".module[data-module='" + moduleName + "']").prop('checked', false);
      var subModuleName = $(permission).data("module") + '-sub';
      var checkBoxes = $(".permission[data-module='" + subModuleName + "']").length;
      var checkedCheckBoxes = $('input[type="checkbox"].' + subModuleName + ':checked').length;
      if (checkBoxes === checkedCheckBoxes) {
        $(".module[data-module='" + moduleName + "']").prop('checked', true);
      } else {
        $(".module[data-module='" + moduleName + "']").prop('checked', false);
      }
    }
  }
  return {
    init: init
  };
}();

/***/ }),

/***/ "./resources/asset/system/js/timeFormat.js":
/*!*************************************************!*\
  !*** ./resources/asset/system/js/timeFormat.js ***!
  \*************************************************/
/***/ (() => {

$(function () {
  timeFormat.init();
});

// Toggle visibility of application settings
var timeFormat = function () {
  var init = function init() {
    attachEventListeners();
  };
  var attachEventListeners = function attachEventListeners() {
    $('.localTime').each(function () {
      var date = $(this).html();
      var format = $(this).attr('format');
      console.log(moment.utc(date));
      var result = moment.utc(date).utcOffset(moment().format("Z")).format(format || "YYYY-MM-DD HH:mm:ss");
      // $(this).html(result)
      $(this).append('   ' + result);
    });
  };
  return {
    init: init
  };
}();

/***/ }),

/***/ "./resources/asset/system/js/translation.js":
/*!**************************************************!*\
  !*** ./resources/asset/system/js/translation.js ***!
  \**************************************************/
/***/ (() => {

$(document).ready(function () {
  languageSelector.init();
  translation.init();
});
var languageSelector = function () {
  var $countrySelector = $('#country_id');
  var $languageSelecor = $('#language_code');
  var $prefix = $countrySelector.data('prefix');
  var $url = $countrySelector.data('url');
  var init = function init() {
    registerEventListeners();
  };
  var registerEventListeners = function registerEventListeners() {
    $countrySelector.on('change', handleCountryChange);
  };
  var handleCountryChange = function handleCountryChange() {
    var countyId = $(this).val();
    populateLanguages(countyId);
  };
  var populateLanguages = function populateLanguages(countryId) {
    var $languageOptions = "<option value=\"\">Select Language</option>";
    $.ajax({
      url: $url + '/' + $prefix + '/country-language/' + countryId,
      type: "GET",
      success: function success(response) {
        var languages = response.languages;
        languages.forEach(function (_ref) {
          var name = _ref.name,
            code = _ref.iso639_1;
          $languageOptions += "<option value=\"".concat(code, "\">").concat(name, " (").concat(code, ")</option>");
        });
        $languageSelecor.html($languageOptions);
      },
      error: function error() {
        $.toast({
          heading: 'ERROR',
          text: 'Something went wrong.',
          showHideTransition: 'plain',
          icon: 'error',
          position: 'bottom-center'
        });
      }
    });
  };
  return {
    init: init
  };
}();
var translation = function () {
  var $content = $('.translation-content');
  var init = function init() {
    registerEventListeners();
  };
  var registerEventListeners = function registerEventListeners() {
    $content.on('change', handleContentChange);
  };
  var handleContentChange = function handleContentChange() {
    var group = $(this).data('group');
    var locale = $(this).data('locale');
    updateText($(this).val(), $(this).data('href'), group, locale);
  };
  var updateText = function updateText(value, url, group, locale) {
    var $csrfToken = $('meta[name="csrf"]').attr('content');
    $.ajax({
      url: url,
      type: 'PUT',
      data: {
        text: value,
        group: group,
        locale: locale,
        _token: $csrfToken
      },
      success: function success() {
        $.toast({
          heading: 'Success',
          text: 'Successfully updated.',
          showHideTransition: 'plain',
          icon: 'success',
          position: 'bottom-center'
        });
      },
      error: function error() {
        $.toast({
          heading: 'ERROR',
          text: 'Something went wrong.',
          showHideTransition: 'plain',
          icon: 'error',
          position: 'bottom-center'
        });
      }
    });
  };
  return {
    init: init
  };
}();

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*********************************************!*\
  !*** ./resources/asset/system/js/system.js ***!
  \*********************************************/
__webpack_require__(/*! ./backend */ "./resources/asset/system/js/backend.js");
__webpack_require__(/*! ./translation */ "./resources/asset/system/js/translation.js");
__webpack_require__(/*! ./admin */ "./resources/asset/system/js/admin.js");
__webpack_require__(/*! ./config */ "./resources/asset/system/js/config.js");
__webpack_require__(/*! ./timeFormat */ "./resources/asset/system/js/timeFormat.js");
__webpack_require__(/*! ./roles */ "./resources/asset/system/js/roles.js");
})();

/******/ })()
;