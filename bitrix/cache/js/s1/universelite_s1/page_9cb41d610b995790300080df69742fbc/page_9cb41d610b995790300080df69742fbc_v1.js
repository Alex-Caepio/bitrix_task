
; /* Start:"a:4:{s:4:"full";s:109:"/bitrix/templates/universelite_s1/components/bitrix/catalog.smart.filter/vertical.2/script.js?168451251424129";s:6:"source";s:93:"/bitrix/templates/universelite_s1/components/bitrix/catalog.smart.filter/vertical.2/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
function JCSmartFilterVertical2(ajaxURL, viewMode, params)
{
	this.ajaxURL = ajaxURL;
	this.form = null;
	this.timer = null;
	this.cacheKey = '';
	this.cache = [];
	this.viewMode = viewMode;
	this.id = params.id;
	this.variable = params.variable;

	if (params && params.SEF_SET_FILTER_URL)
	{
		this.bindUrlToButton(this.id.setFilter, params.SEF_SET_FILTER_URL);
		this.sef = true;
	}
	if (params && params.SEF_DEL_FILTER_URL)
	{
		this.bindUrlToButton(this.id.delFilter, params.SEF_DEL_FILTER_URL);
	}

    var _ = template.getLibrary('_');
    var events = template.getLibrary('events');

    _.assignIn(this, new events());
}

JCSmartFilterVertical2.prototype.keyup = function(input)
{
	if(!!this.timer)
	{
		clearTimeout(this.timer);
	}
	this.timer = setTimeout(BX.delegate(function(){
		this.reload(input);
	}, this), 500);
};

JCSmartFilterVertical2.prototype.click = function(checkbox)
{
	if(!!this.timer)
	{
		clearTimeout(this.timer);
	}

	this.timer = setTimeout(BX.delegate(function(){
		this.reload(checkbox);
	}, this), 500);
};

JCSmartFilterVertical2.prototype.reload = function(input)
{
	if (this.cacheKey !== '')
	{
		//Postprone backend query
		if(!!this.timer)
		{
			clearTimeout(this.timer);
		}
		this.timer = setTimeout(BX.delegate(function(){
			this.reload(input);
		}, this), 1000);
		return;
	}
	this.cacheKey = '|';

	this.position = BX.pos(input, true);
	this.form = BX.findParent(input, {'tag':'form'});
	if (this.form)
	{
		var values = [];
		values[0] = {name: 'ajax', value: 'y'};
		this.gatherInputsValues(values, BX.findChildren(this.form, {'tag': new RegExp('^(input|select)$', 'i')}, true));

		for (var i = 0; i < values.length; i++)
			this.cacheKey += values[i].name + ':' + values[i].value + '|';

		if (this.cache[this.cacheKey])
		{
			this.curFilterinput = input;
			this.postHandler(this.cache[this.cacheKey], true);
		}
		else
		{
			if (this.sef)
			{
				var set_filter = BX(this.id.setFilter);

				if (set_filter)
					set_filter.disabled = true;
			}
			this.curFilterinput = input;
			BX.ajax.loadJSON(
				this.ajaxURL,
				this.values2post(values),
				BX.delegate(this.postHandler, this)
			);
		}
	}
};

JCSmartFilterVertical2.prototype.updateItem = function (PID, arItem)
{
	if (arItem.PROPERTY_TYPE === 'N' || arItem.PRICE)
	{
		var trackBar = window['trackBar' + PID];
		if (!trackBar && arItem.ENCODED_ID)
			trackBar = window['trackBar' + arItem.ENCODED_ID];

		if (trackBar && arItem.VALUES)
		{
			if (arItem.VALUES.MIN)
			{
				if (arItem.VALUES.MIN.FILTERED_VALUE)
					trackBar.setMinFilteredValue(arItem.VALUES.MIN.FILTERED_VALUE);
				else
					trackBar.setMinFilteredValue(arItem.VALUES.MIN.VALUE);
			}

			if (arItem.VALUES.MAX)
			{
				if (arItem.VALUES.MAX.FILTERED_VALUE)
					trackBar.setMaxFilteredValue(arItem.VALUES.MAX.FILTERED_VALUE);
				else
					trackBar.setMaxFilteredValue(arItem.VALUES.MAX.VALUE);
			}
		}
	}
	else if (arItem.VALUES)
	{
		for (var i in arItem.VALUES)
		{
			if (arItem.VALUES.hasOwnProperty(i))
			{
				var value = arItem.VALUES[i];
				var control = BX(value.CONTROL_ID);

				if (!!control)
				{
					var label = document.querySelector('[data-role="label_'+value.CONTROL_ID+'"]');
					if (value.DISABLED)
					{
						control.setAttribute('disabled', 'disabled');

						if (label)
							BX.addClass(label, 'disabled');
						else
							BX.addClass(control.parentNode, 'disabled');
					}
					else
					{
                        control.removeAttribute('disabled');

						if (label)
							BX.removeClass(label, 'disabled');
						else
							BX.removeClass(control.parentNode, 'disabled');
					}

					if (value.CHECKED) {
                        control.removeAttribute('disabled');

                        if (label)
                            BX.removeClass(label, 'disabled');
                        else
                            BX.removeClass(control.parentNode, 'disabled');
                    }

					if (value.hasOwnProperty('ELEMENT_COUNT'))
					{
						label = document.querySelector('[data-role="count_'+value.CONTROL_ID+'"]');
						if (label)
							label.innerHTML = value.ELEMENT_COUNT;
					}
				}
			}
		}
	}
};

JCSmartFilterVertical2.prototype.postHandler = function (result, fromCache)
{
	var hrefFILTER, url, curProp;
	var modef = BX('SmartFilterVertical2-modef');
	var modef_num = BX('SmartFilterVertical2-modef-num');
    var search = {
        'field': BX.findChild(BX.findParent(this.curFilterinput, {'class':'bx-filter-parameters-box'}), {'class':'smart-filter-search-wrapper'}, true, false),
        'height': 0
    };

    var scroll = {
        'block': BX.findChild(BX.findParent(this.curFilterinput, {'class':'bx-filter-parameters-box'}), {'class':'scrollbar-inner'}, true, false),
        'height': 0
    };

    if (search.field)
    	search.height = $(search.field).outerHeight(true);

	if (!!result && !!result.ITEMS)
	{
		for(var PID in result.ITEMS)
		{
			if (result.ITEMS.hasOwnProperty(PID))
			{
				this.updateItem(PID, result.ITEMS[PID]);
			}
		}

		if (!!modef && !!modef_num)
		{
			modef_num.innerHTML = result.ELEMENT_COUNT;
			hrefFILTER = BX.findChildren(modef, {tag: 'A'}, true);

			if (result.FILTER_URL && hrefFILTER)
			{
				hrefFILTER[0].href = BX.util.htmlspecialcharsback(result.FILTER_URL);
			}

			if (result.FILTER_AJAX_URL && result.COMPONENT_CONTAINER_ID)
			{
				BX.unbindAll(hrefFILTER[0]);
				BX.bind(hrefFILTER[0], 'click', function(e)
				{
					url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
					BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
					return BX.PreventDefault(e);
				});
			}

			if (result.INSTANT_RELOAD && result.COMPONENT_CONTAINER_ID)
			{
				url = BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL);
				BX.ajax.insertToNode(url, result.COMPONENT_CONTAINER_ID);
			}
			else
			{
				this.emit('refresh', BX.util.htmlspecialcharsback(result.FILTER_AJAX_URL));

				if (modef.style.display === 'none')
				{
					modef.style.display = 'inline-block';
				}

				if (this.viewMode === "VERTICAL")
				{
					curProp = BX.findChild(BX.findParent(this.curFilterinput, {'class':'bx-filter-parameters-box'}), {'class':'bx-filter-container-modef'}, true, false);

					if (curProp)
						curProp.appendChild(modef);
				}

				if (result.SEF_SET_FILTER_URL)
				{
					this.bindUrlToButton(this.id.setFilter, result.SEF_SET_FILTER_URL);
				}
			}
		}
	}

	if (this.sef)
	{
		var set_filter = BX(this.id.setFilter);

		if (set_filter)
			set_filter.disabled = false;
	}

	if (!fromCache && this.cacheKey !== '')
	{
		this.cache[this.cacheKey] = result;
	}
	this.cacheKey = '';
};

JCSmartFilterVertical2.prototype.bindUrlToButton = function (buttonId, url)
{
	var button = BX(buttonId);
	if (button)
	{
		var proxy = function(j, func)
		{
			return function()
			{
				return func(j);
			}
		};

		if (button.type === 'submit')
			button.type = 'button';

		BX.bind(button, 'click', proxy(url, function(url)
		{
			window.location.href = url;
			return false;
		}));
	}
};

JCSmartFilterVertical2.prototype.gatherInputsValues = function (values, elements)
{
	if(elements)
	{
		for(var i = 0; i < elements.length; i++)
		{
			var el = elements[i];
			if (el.disabled || !el.type)
				continue;

			switch(el.type.toLowerCase())
			{
				case 'text':
				case 'textarea':
				case 'password':
				case 'hidden':
				case 'select-one':
					if(el.value.length)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'radio':
				case 'checkbox':
					if(el.checked)
						values[values.length] = {name : el.name, value : el.value};
					break;
				case 'select-multiple':
					for (var j = 0; j < el.options.length; j++)
					{
						if (el.options[j].selected)
							values[values.length] = {name : el.name, value : el.options[j].value};
					}
					break;
				default:
					break;
			}
		}
	}
};

JCSmartFilterVertical2.prototype.values2post = function (values)
{
	var post = [];
	var current = post;
	var i = 0;

	while(i < values.length)
	{
		var p = values[i].name.indexOf('[');
		if(p === -1)
		{
			current[values[i].name] = values[i].value;
			current = post;
			i++;
		}
		else
		{
			var name = values[i].name.substring(0, p);
			var rest = values[i].name.substring(p+1);
			if(!current[name])
				current[name] = [];

			var pp = rest.indexOf(']');
			if(pp === -1)
			{
				//Error - not balanced brackets
				current = post;
				i++;
			}
			else if(pp === 0)
			{
				//No index specified - so take the next integer
				current = current[name];
				values[i].name = '' + current.length;
			}
			else
			{
				//Now index name becomes and name and we go deeper into the array
				current = current[name];
				values[i].name = rest.substring(0, pp) + rest.substring(pp+1);
			}
		}
	}
	return post;
};

JCSmartFilterVertical2.prototype.hideFilterProps = function(element)
{
	var obj = element.parentNode,
		filterBlock = obj.querySelector("[data-role='bx_filter_block']"),
		propAngle = obj.querySelector("[data-role='prop_angle']");
	var scrollBlock = obj.querySelector("[data-role='scrollbar']");

	if(obj.getAttribute('data-expanded') === 'true')
	{
		new BX.easing({
			duration : 300,
			start : { opacity: 1,  height: filterBlock.offsetHeight },
			finish : { opacity: 0, height:0 },
			transition : BX.easing.transitions.quart,
			step : function(state){
				filterBlock.style.opacity = state.opacity;
				filterBlock.style.height = state.height + "px";
			},
			complete : function() {
				filterBlock.setAttribute("style", "");
				obj.setAttribute('data-expanded', 'false');
			}
		}).animate();

		BX.removeClass(propAngle, "property-expanded");
	}
	else
	{
		filterBlock.style.display = "block";
		filterBlock.style.opacity = 0;
		filterBlock.style.height = "auto";

		var obj_children_height = filterBlock.offsetHeight;

		if (!!scrollBlock && obj_children_height < 250) {
            obj_children_height = obj_children_height + 250;
        }

		filterBlock.style.height = 0;

		new BX.easing({
			duration : 300,
			start : { opacity: 0,  height: 0 },
			finish : { opacity: 1, height: obj_children_height },
			transition : BX.easing.transitions.quart,
			step : function(state){
				filterBlock.style.opacity = state.opacity;
				filterBlock.style.height = state.height + "px";
			},
			complete : function() {
                $(filterBlock).css('max-height', obj_children_height + 'px');
                filterBlock.style.height = 'auto';
			}
		}).animate();

        obj.setAttribute('data-expanded', 'true');
		BX.addClass(propAngle, "property-expanded");
	}
};

JCSmartFilterVertical2.prototype.showDropDownPopup = function(element, popupId)
{
	var contentNode = element.querySelector('[data-role="dropdownContent"]');
	var popup = BX.PopupWindowManager.create("smartFilterDropDown"+popupId, element, {
		autoHide: true,
		offsetLeft: 0,
		offsetTop: 3,
		overlay : false,
		draggable: {restrict:true},
		closeByEsc: true,
		content: contentNode,
		className: 'popup-window-catalog-smart-filter popup-window-catalog-smart-filter-vertical-2'
	});

	popup.popupContainer.style.maxWidth = element.offsetWidth + 'px';
	popup.show();
};

JCSmartFilterVertical2.prototype.selectDropDownItem = function(element, controlId)
{
	this.keyup(BX(controlId));

	var wrapContainer = BX.findParent(BX(controlId), {className:"catalog-smart-filter-item-select-wrapper"}, false);

	var currentOption = wrapContainer.querySelector('[data-role="currentOption"]');
	currentOption.innerHTML = element.innerHTML;
	BX.PopupWindowManager.getCurrentPopup().close();
};

BX.namespace("BX.Iblock.SmartFilterVertical2");
BX.Iblock.SmartFilterVertical2 = (function()
{
	var SmartFilter = function(arParams)
	{
		if (typeof arParams === 'object')
		{
			this.variable = arParams.variable;
			this.leftSlider = BX(arParams.leftSlider);
			this.rightSlider = BX(arParams.rightSlider);
			this.tracker = BX(arParams.tracker);
			this.trackerWrap = BX(arParams.trackerWrap);

			this.minInput = BX(arParams.minInputId);
			this.maxInput = BX(arParams.maxInputId);

			this.minPrice = parseFloat(arParams.minPrice);
			this.maxPrice = parseFloat(arParams.maxPrice);

			this.curMinPrice = parseFloat(arParams.curMinPrice);
			this.curMaxPrice = parseFloat(arParams.curMaxPrice);

			this.fltMinPrice = arParams.fltMinPrice ? parseFloat(arParams.fltMinPrice) : parseFloat(arParams.curMinPrice);
			this.fltMaxPrice = arParams.fltMaxPrice ? parseFloat(arParams.fltMaxPrice) : parseFloat(arParams.curMaxPrice);

			this.precision = arParams.precision || 0;

			this.priceDiff = this.maxPrice - this.minPrice;

			this.leftPercent = 0;
			this.rightPercent = 0;

			this.fltMinPercent = 0;
			this.fltMaxPercent = 0;

			this.colorUnavailableActive = BX(arParams.colorUnavailableActive);//gray
			this.colorAvailableActive = BX(arParams.colorAvailableActive);//blue
			this.colorAvailableInactive = BX(arParams.colorAvailableInactive);//light blue

			this.isTouch = false;

			this.init();

			if ('ontouchstart' in document.documentElement)
			{
				this.isTouch = true;

				BX.bind(this.leftSlider, "touchstart", BX.proxy(function(event){
					this.onMoveLeftSlider(event)
				}, this));

				BX.bind(this.rightSlider, "touchstart", BX.proxy(function(event){
					this.onMoveRightSlider(event)
				}, this));
			}
			else
			{
				BX.bind(this.leftSlider, "mousedown", BX.proxy(function(event){
					this.onMoveLeftSlider(event)
				}, this));

				BX.bind(this.rightSlider, "mousedown", BX.proxy(function(event){
					this.onMoveRightSlider(event)
				}, this));
			}

			BX.bind(this.minInput, "keyup", BX.proxy(function(event){
				this.onInputChange();
			}, this));

			BX.bind(this.maxInput, "keyup", BX.proxy(function(event){
				this.onInputChange();
			}, this));
		}
	};

	SmartFilter.prototype.init = function()
	{
		var priceDiff;

		if (this.curMinPrice > this.minPrice)
		{
			priceDiff = this.curMinPrice - this.minPrice;
			this.leftPercent = (priceDiff*100)/this.priceDiff;

			this.leftSlider.style.left = this.leftPercent + "%";
			this.colorUnavailableActive.style.left = this.leftPercent + "%";
		}

		this.setMinFilteredValue(this.fltMinPrice);

		if (this.curMaxPrice < this.maxPrice)
		{
			priceDiff = this.maxPrice - this.curMaxPrice;
			this.rightPercent = (priceDiff*100)/this.priceDiff;

			this.rightSlider.style.right = this.rightPercent + "%";
			this.colorUnavailableActive.style.right = this.rightPercent + "%";
		}

		this.setMaxFilteredValue(this.fltMaxPrice);
	};

	SmartFilter.prototype.setMinFilteredValue = function (fltMinPrice)
	{
		this.fltMinPrice = parseFloat(fltMinPrice);

		if (this.fltMinPrice >= this.minPrice)
		{
			var priceDiff = this.fltMinPrice - this.minPrice;
			this.fltMinPercent = (priceDiff*100)/this.priceDiff;

			if (this.leftPercent > this.fltMinPercent)
				this.colorAvailableActive.style.left = this.leftPercent + "%";
			else
				this.colorAvailableActive.style.left = this.fltMinPercent + "%";

			this.colorAvailableInactive.style.left = this.fltMinPercent + "%";
		}
		else
		{
			this.colorAvailableActive.style.left = "0%";
			this.colorAvailableInactive.style.left = "0%";
		}
	};

	SmartFilter.prototype.setMaxFilteredValue = function (fltMaxPrice)
	{
		this.fltMaxPrice = parseFloat(fltMaxPrice);
		if (this.fltMaxPrice <= this.maxPrice)
		{
			var priceDiff = this.maxPrice - this.fltMaxPrice;
			this.fltMaxPercent = (priceDiff*100)/this.priceDiff;

			if (this.rightPercent > this.fltMaxPercent)
				this.colorAvailableActive.style.right = this.rightPercent + "%";
			else
				this.colorAvailableActive.style.right = this.fltMaxPercent + "%";

			this.colorAvailableInactive.style.right = this.fltMaxPercent + "%";
		}
		else
		{
			this.colorAvailableActive.style.right = "0%";
			this.colorAvailableInactive.style.right = "0%";
		}
	};

	SmartFilter.prototype.getXCoord = function(elem)
	{
		var box = elem.getBoundingClientRect();
		var body = document.body;
		var docElem = document.documentElement;

		var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;
		var clientLeft = docElem.clientLeft || body.clientLeft || 0;
		var left = box.left + scrollLeft - clientLeft;

		return Math.round(left);
	};

	SmartFilter.prototype.getPageX = function(e)
	{
		e = e || window.event;
		var pageX = null;

		if (this.isTouch && event.targetTouches[0] !== null)
		{
			pageX = e.targetTouches[0].pageX;
		}
		else if (e.pageX !== null)
		{
			pageX = e.pageX;
		}
		else if (e.clientX !== null)
		{
			var html = document.documentElement;
			var body = document.body;

			pageX = e.clientX + (html.scrollLeft || body && body.scrollLeft || 0);
			pageX -= html.clientLeft || 0;
		}

		return pageX;
	};

	SmartFilter.prototype.recountMinPrice = function()
	{
		var newMinPrice = (this.priceDiff*this.leftPercent)/100;
		newMinPrice = (this.minPrice + newMinPrice).toFixed(this.precision);

		if (newMinPrice !== this.minPrice)
			this.minInput.value = newMinPrice;
		else
			this.minInput.value = this.minPrice;
		window[this.variable].keyup(this.minInput);
	};

	SmartFilter.prototype.recountMaxPrice = function()
	{
		var newMaxPrice = (this.priceDiff*this.rightPercent)/100;
		newMaxPrice = (this.maxPrice - newMaxPrice).toFixed(this.precision);

		if (newMaxPrice !== this.maxPrice)
			this.maxInput.value = newMaxPrice;
		else
			this.maxInput.value = this.maxPrice;
        window[this.variable].keyup(this.maxInput);
	};

	SmartFilter.prototype.onInputChange = function ()
	{
		var priceDiff;
		if (this.minInput.value)
		{
			var leftInputValue = this.minInput.value;
			if (leftInputValue < this.minPrice)
				leftInputValue = this.minPrice;

			if (leftInputValue > this.maxPrice)
				leftInputValue = this.maxPrice;

			priceDiff = leftInputValue - this.minPrice;
			this.leftPercent = (priceDiff*100)/this.priceDiff;

			this.makeLeftSliderMove(false);
		}

		if (this.maxInput.value)
		{
			var rightInputValue = this.maxInput.value;
			if (rightInputValue < this.minPrice)
				rightInputValue = this.minPrice;

			if (rightInputValue > this.maxPrice)
				rightInputValue = this.maxPrice;

			priceDiff = this.maxPrice - rightInputValue;
			this.rightPercent = (priceDiff*100)/this.priceDiff;

			this.makeRightSliderMove(false);
		}

		if (this.maxInput) {
            window[this.variable].keyup(this.maxInput);
        } else if (this.minInput) {
            window[this.variable].keyup(this.minInput);
		}
	};

	SmartFilter.prototype.makeLeftSliderMove = function(recountPrice)
	{
		recountPrice = (recountPrice !== false);

		this.leftSlider.style.left = this.leftPercent + "%";
		this.colorUnavailableActive.style.left = this.leftPercent + "%";

		var areBothSlidersMoving = false;
		if (this.leftPercent + this.rightPercent >= 100)
		{
			areBothSlidersMoving = true;
			this.rightPercent = 100 - this.leftPercent;
			this.rightSlider.style.right = this.rightPercent + "%";
			this.colorUnavailableActive.style.right = this.rightPercent + "%";
		}

		if (this.leftPercent >= this.fltMinPercent && this.leftPercent <= (100-this.fltMaxPercent))
		{
			this.colorAvailableActive.style.left = this.leftPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = 100 - this.leftPercent + "%";
			}
		}
		else if(this.leftPercent <= this.fltMinPercent)
		{
			this.colorAvailableActive.style.left = this.fltMinPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = 100 - this.fltMinPercent + "%";
			}
		}
		else if(this.leftPercent >= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.left = 100-this.fltMaxPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.right = this.fltMaxPercent + "%";
			}
		}

		if (recountPrice)
		{
			this.recountMinPrice();
			if (areBothSlidersMoving)
				this.recountMaxPrice();
		}
	};

	SmartFilter.prototype.countNewLeft = function(event)
	{
		var pageX = this.getPageX(event);

		var trackerXCoord = this.getXCoord(this.trackerWrap);
		var rightEdge = this.trackerWrap.offsetWidth;

		var newLeft = pageX - trackerXCoord;

		if (newLeft < 0)
			newLeft = 0;
		else if (newLeft > rightEdge)
			newLeft = rightEdge;

		return newLeft;
	};

	SmartFilter.prototype.onMoveLeftSlider = function(e)
	{
		if (!this.isTouch)
		{
			this.leftSlider.ondragstart = function() {
				return false;
			};
		}

		if (!this.isTouch)
		{
			document.onmousemove = BX.proxy(function(event) {
				this.leftPercent = ((this.countNewLeft(event)*100)/this.trackerWrap.offsetWidth);
				this.makeLeftSliderMove();
			}, this);

			document.onmouseup = function() {
				document.onmousemove = document.onmouseup = null;
			};
		}
		else
		{
			document.ontouchmove = BX.proxy(function(event) {
				this.leftPercent = ((this.countNewLeft(event)*100)/this.trackerWrap.offsetWidth);
				this.makeLeftSliderMove();
			}, this);

			document.ontouchend = function() {
				document.ontouchmove = document.touchend = null;
			};
		}

		return false;
	};

	SmartFilter.prototype.makeRightSliderMove = function(recountPrice)
	{
		recountPrice = (recountPrice !== false);

		this.rightSlider.style.right = this.rightPercent + "%";
		this.colorUnavailableActive.style.right = this.rightPercent + "%";

		var areBothSlidersMoving = false;
		if (this.leftPercent + this.rightPercent >= 100)
		{
			areBothSlidersMoving = true;
			this.leftPercent = 100 - this.rightPercent;
			this.leftSlider.style.left = this.leftPercent + "%";
			this.colorUnavailableActive.style.left = this.leftPercent + "%";
		}

		if ((100-this.rightPercent) >= this.fltMinPercent && this.rightPercent >= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.right = this.rightPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = 100 - this.rightPercent + "%";
			}
		}
		else if(this.rightPercent <= this.fltMaxPercent)
		{
			this.colorAvailableActive.style.right = this.fltMaxPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = 100 - this.fltMaxPercent + "%";
			}
		}
		else if((100-this.rightPercent) <= this.fltMinPercent)
		{
			this.colorAvailableActive.style.right = 100-this.fltMinPercent + "%";
			if (areBothSlidersMoving)
			{
				this.colorAvailableActive.style.left = this.fltMinPercent + "%";
			}
		}

		if (recountPrice)
		{
			this.recountMaxPrice();
			if (areBothSlidersMoving)
				this.recountMinPrice();
		}
	};

	SmartFilter.prototype.onMoveRightSlider = function(e)
	{
		if (!this.isTouch)
		{
			this.rightSlider.ondragstart = function() {
				return false;
			};
		}

		if (!this.isTouch)
		{
			document.onmousemove = BX.proxy(function(event) {
				this.rightPercent = 100-(((this.countNewLeft(event))*100)/(this.trackerWrap.offsetWidth));
				this.makeRightSliderMove();
			}, this);

			document.onmouseup = function() {
				document.onmousemove = document.onmouseup = null;
			};
		}
		else
		{
			document.ontouchmove = BX.proxy(function(event) {
				this.rightPercent = 100-(((this.countNewLeft(event))*100)/(this.trackerWrap.offsetWidth));
				this.makeRightSliderMove();
			}, this);

			document.ontouchend = function() {
				document.ontouchmove = document.ontouchend = null;
			};
		}

		return false;
	};

	return SmartFilter;
})();
/* End */
;
; /* Start:"a:4:{s:4:"full";s:111:"/bitrix/templates/universelite_s1/components/bitrix/catalog.smart.filter/mobile.1/script.min.js?168451251412170";s:6:"source";s:91:"/bitrix/templates/universelite_s1/components/bitrix/catalog.smart.filter/mobile.1/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
function JCSmartFilterMobile1(t,e){this.ajaxURL=t,this.form=null,this.timer=null,this.cacheKey="",this.cache=[],this.popups=[],this.quantity=BX("quantity-filter-mobile"),e&&e.SEF_SET_FILTER_URL&&(this.bindUrlToButton("set-filter-mobile",e.SEF_SET_FILTER_URL),this.sef=!0),e&&e.SEF_DEL_FILTER_URL&&this.bindUrlToButton("delete-filter-mobile",e.SEF_DEL_FILTER_URL)}JCSmartFilterMobile1.prototype.keyup=function(t){this.timer&&clearTimeout(this.timer),this.timer=setTimeout(BX.delegate(function(){this.reload(t)},this),500)},JCSmartFilterMobile1.prototype.click=function(t){this.timer&&clearTimeout(this.timer),this.timer=setTimeout(BX.delegate(function(){this.reload(t)},this),500)},JCSmartFilterMobile1.prototype.reload=function(t){if(""!==this.cacheKey)return this.timer&&clearTimeout(this.timer),void(this.timer=setTimeout(BX.delegate(function(){this.reload(t)},this),1e3));if(this.cacheKey="|",this.position=BX.pos(t,!0),this.form=BX.findParent(t,{tag:"form"}),this.form){var e=[];e[0]={name:"ajax",value:"y"},this.gatherInputsValues(e,BX.findChildren(this.form,{tag:new RegExp("^(input|select)$","i")},!0));for(var i=0;i<e.length;i++)this.cacheKey+=e[i].name+":"+e[i].value+"|";if(this.cache[this.cacheKey])this.curFilterinput=t,this.postHandler(this.cache[this.cacheKey],!0);else{if(this.sef)BX("set-filter-mobile").disabled=!0;this.curFilterinput=t,BX.ajax.loadJSON(this.ajaxURL,this.values2post(e),BX.delegate(this.postHandler,this))}}},JCSmartFilterMobile1.prototype.updateItem=function(t,e){if("A"===e.PROPERTY_TYPE||e.PRICE){var i=window["trackBarMobile"+t];!i&&e.ENCODED_ID&&(i=window["trackBarMobile"+e.ENCODED_ID]),i&&e.VALUES&&(e.VALUES.MIN&&(e.VALUES.MIN.FILTERED_VALUE?i.setMinFilteredValue(e.VALUES.MIN.FILTERED_VALUE):i.setMinFilteredValue(e.VALUES.MIN.VALUE)),e.VALUES.MAX&&(e.VALUES.MAX.FILTERED_VALUE?i.setMaxFilteredValue(e.VALUES.MAX.FILTERED_VALUE):i.setMaxFilteredValue(e.VALUES.MAX.VALUE)))}else if(e.VALUES)for(var r in e.VALUES)if(e.VALUES.hasOwnProperty(r)){var s=e.VALUES[r],l=BX(s.CONTROL_ID+"_mobile");if(l)if("SELECT"===l.tagName){if(l.length>0){var n=l.namedItem(s.CONTROL_ID+"_mobile");null!==n&&(s.DISABLED?(n.value===l.value&&n.selected&&(n.selected=!1,l.dispatchEvent(new Event("change"))),n.disabled=!0):n.disabled=!1)}}else{var h=document.querySelector('[data-property="'+s.CONTROL_ID+'"]');s.DISABLED?(h?BX.addClass(h,"disabled"):BX.addClass(l.parentNode,"disabled"),l.checked=!1,l.disabled=!0):(h?BX.removeClass(h,"disabled"):BX.removeClass(l.parentNode,"disabled"),l.disabled=!1)}}},JCSmartFilterMobile1.prototype.postHandler=function(t,e){var i;if(t&&t.ITEMS){for(var r in this.popups)this.popups.hasOwnProperty(r)&&this.popups[r].destroy();for(var s in this.popups=[],t.ITEMS)t.ITEMS.hasOwnProperty(s)&&this.updateItem(s,t.ITEMS[s]);this.quantity&&(this.quantity.innerHTML="("+t.ELEMENT_COUNT+")"),t.INSTANT_RELOAD&&t.COMPONENT_CONTAINER_ID?(i=BX.util.htmlspecialcharsback(t.FILTER_AJAX_URL),BX.ajax.insertToNode(i,t.COMPONENT_CONTAINER_ID)):t.SEF_SET_FILTER_URL&&this.bindUrlToButton("set-filter-mobile",t.SEF_SET_FILTER_URL)}this.sef&&(BX("set-filter-mobile").disabled=!1);e||""===this.cacheKey||(this.cache[this.cacheKey]=t),this.cacheKey=""},JCSmartFilterMobile1.prototype.bindUrlToButton=function(t,e){var i,r,s=BX(t);if(s){"submit"===s.type&&(s.type="button"),BX.bind(s,"click",(i=e,r=function(t){return window.location.href=t,!1},function(){return r(i)}))}},JCSmartFilterMobile1.prototype.gatherInputsValues=function(t,e){if(e)for(var i=0;i<e.length;i++){var r=e[i];if(!r.disabled&&r.type)switch(r.type.toLowerCase()){case"text":case"textarea":case"password":case"hidden":case"select-one":r.value.length&&(t[t.length]={name:r.name,value:r.value});break;case"radio":case"checkbox":r.checked&&(t[t.length]={name:r.name,value:r.value});break;case"select-multiple":for(var s=0;s<r.options.length;s++)r.options[s].selected&&(t[t.length]={name:r.name,value:r.options[s].value})}}},JCSmartFilterMobile1.prototype.values2post=function(t){for(var e=[],i=e,r=0;r<t.length;){var s=t[r].name.indexOf("[");if(-1==s)i[t[r].name]=t[r].value,i=e,r++;else{var l=t[r].name.substring(0,s),n=t[r].name.substring(s+1);i[l]||(i[l]=[]);var h=n.indexOf("]");-1==h?(i=e,r++):0==h?(i=i[l],t[r].name=""+i.length):(i=i[l],t[r].name=n.substring(0,h)+n.substring(h+1))}}return e},BX.namespace("BX.Iblock.SmartFilterMobile1"),BX.Iblock.SmartFilterMobile1=function(){var t=function(t){"object"==typeof t&&(this.leftSlider=BX(t.leftSlider),this.rightSlider=BX(t.rightSlider),this.tracker=BX(t.tracker),this.trackerWrap=BX(t.trackerWrap),this.minInput=BX(t.minInputId),this.maxInput=BX(t.maxInputId),this.minPrice=parseFloat(t.minPrice),this.maxPrice=parseFloat(t.maxPrice),this.curMinPrice=parseFloat(t.curMinPrice),this.curMaxPrice=parseFloat(t.curMaxPrice),this.fltMinPrice=t.fltMinPrice?parseFloat(t.fltMinPrice):parseFloat(t.curMinPrice),this.fltMaxPrice=t.fltMaxPrice?parseFloat(t.fltMaxPrice):parseFloat(t.curMaxPrice),this.precision=t.precision||0,this.priceDiff=this.maxPrice-this.minPrice,this.leftPercent=0,this.rightPercent=0,this.fltMinPercent=0,this.fltMaxPercent=0,this.colorUnavailableActive=BX(t.colorUnavailableActive),this.colorAvailableActive=BX(t.colorAvailableActive),this.colorAvailableInactive=BX(t.colorAvailableInactive),this.isTouch=!1,this.init(),"ontouchstart"in document.documentElement?(this.isTouch=!0,BX.bind(this.leftSlider,"touchstart",BX.proxy(function(t){this.onMoveLeftSlider(t)},this)),BX.bind(this.rightSlider,"touchstart",BX.proxy(function(t){this.onMoveRightSlider(t)},this))):(BX.bind(this.leftSlider,"mousedown",BX.proxy(function(t){this.onMoveLeftSlider(t)},this)),BX.bind(this.rightSlider,"mousedown",BX.proxy(function(t){this.onMoveRightSlider(t)},this))),BX.bind(this.minInput,"keyup",BX.proxy(function(t){this.onInputChange()},this)),BX.bind(this.maxInput,"keyup",BX.proxy(function(t){this.onInputChange()},this)))};return t.prototype.init=function(){var t;this.curMinPrice>this.minPrice&&(t=this.curMinPrice-this.minPrice,this.leftPercent=100*t/this.priceDiff,this.leftSlider.style.left=this.leftPercent+"%",this.colorUnavailableActive.style.left=this.leftPercent+"%"),this.setMinFilteredValue(this.fltMinPrice),this.curMaxPrice<this.maxPrice&&(t=this.maxPrice-this.curMaxPrice,this.rightPercent=100*t/this.priceDiff,this.rightSlider.style.right=this.rightPercent+"%",this.colorUnavailableActive.style.right=this.rightPercent+"%"),this.setMaxFilteredValue(this.fltMaxPrice)},t.prototype.setMinFilteredValue=function(t){if(this.fltMinPrice=parseFloat(t),this.fltMinPrice>=this.minPrice){var e=this.fltMinPrice-this.minPrice;this.fltMinPercent=100*e/this.priceDiff,this.leftPercent>this.fltMinPercent?this.colorAvailableActive.style.left=this.leftPercent+"%":this.colorAvailableActive.style.left=this.fltMinPercent+"%",this.colorAvailableInactive.style.left=this.fltMinPercent+"%"}else this.colorAvailableActive.style.left="0%",this.colorAvailableInactive.style.left="0%"},t.prototype.setMaxFilteredValue=function(t){if(this.fltMaxPrice=parseFloat(t),this.fltMaxPrice<=this.maxPrice){var e=this.maxPrice-this.fltMaxPrice;this.fltMaxPercent=100*e/this.priceDiff,this.rightPercent>this.fltMaxPercent?this.colorAvailableActive.style.right=this.rightPercent+"%":this.colorAvailableActive.style.right=this.fltMaxPercent+"%",this.colorAvailableInactive.style.right=this.fltMaxPercent+"%"}else this.colorAvailableActive.style.right="0%",this.colorAvailableInactive.style.right="0%"},t.prototype.getXCoord=function(t){var e=t.getBoundingClientRect(),i=document.body,r=document.documentElement,s=window.pageXOffset||r.scrollLeft||i.scrollLeft,l=r.clientLeft||i.clientLeft||0,n=e.left+s-l;return Math.round(n)},t.prototype.getPageX=function(t){var e=null;if(t=t||window.event,this.isTouch&&null!=event.targetTouches[0])e=t.targetTouches[0].pageX;else if(null!=t.pageX)e=t.pageX;else if(null!=t.clientX){var i=document.documentElement,r=document.body;e=t.clientX+(i.scrollLeft||r&&r.scrollLeft||0),e-=i.clientLeft||0}return e},t.prototype.recountMinPrice=function(){var t=this.priceDiff*this.leftPercent/100;(t=(this.minPrice+t).toFixed(this.precision))!=this.minPrice?this.minInput.value=t:this.minInput.value="",mobileFilter.keyup(this.minInput)},t.prototype.recountMaxPrice=function(){var t=this.priceDiff*this.rightPercent/100;(t=(this.maxPrice-t).toFixed(this.precision))!=this.maxPrice?this.maxInput.value=t:this.maxInput.value="",mobileFilter.keyup(this.maxInput)},t.prototype.onInputChange=function(){var t;if(this.minInput.value){var e=this.minInput.value;e<this.minPrice&&(e=this.minPrice),e>this.maxPrice&&(e=this.maxPrice),t=e-this.minPrice,this.leftPercent=100*t/this.priceDiff,this.makeLeftSliderMove(!1)}if(this.maxInput.value){var i=this.maxInput.value;i<this.minPrice&&(i=this.minPrice),i>this.maxPrice&&(i=this.maxPrice),t=this.maxPrice-i,this.rightPercent=100*t/this.priceDiff,this.makeRightSliderMove(!1)}},t.prototype.makeLeftSliderMove=function(t){var e=!1;t=!1!==t,this.leftSlider.style.left=this.leftPercent+"%",this.colorUnavailableActive.style.left=this.leftPercent+"%",this.leftPercent+this.rightPercent>=100&&(e=!0,this.rightPercent=100-this.leftPercent,this.rightSlider.style.right=this.rightPercent+"%",this.colorUnavailableActive.style.right=this.rightPercent+"%"),this.leftPercent>=this.fltMinPercent&&this.leftPercent<=100-this.fltMaxPercent?(this.colorAvailableActive.style.left=this.leftPercent+"%",e&&(this.colorAvailableActive.style.right=100-this.leftPercent+"%")):this.leftPercent<=this.fltMinPercent?(this.colorAvailableActive.style.left=this.fltMinPercent+"%",e&&(this.colorAvailableActive.style.right=100-this.fltMinPercent+"%")):this.leftPercent>=this.fltMaxPercent&&(this.colorAvailableActive.style.left=100-this.fltMaxPercent+"%",e&&(this.colorAvailableActive.style.right=this.fltMaxPercent+"%")),t&&(this.recountMinPrice(),e&&this.recountMaxPrice())},t.prototype.countNewLeft=function(t){var e=this.getPageX(t),i=this.getXCoord(this.trackerWrap),r=this.trackerWrap.offsetWidth,s=e-i;return s<0?s=0:s>r&&(s=r),s},t.prototype.onMoveLeftSlider=function(t){return this.isTouch||(this.leftSlider.ondragstart=function(){return!1}),this.isTouch?(document.ontouchmove=BX.proxy(function(t){this.leftPercent=100*this.countNewLeft(t)/this.trackerWrap.offsetWidth,this.makeLeftSliderMove()},this),document.ontouchend=function(){document.ontouchmove=document.touchend=null}):(document.onmousemove=BX.proxy(function(t){this.leftPercent=100*this.countNewLeft(t)/this.trackerWrap.offsetWidth,this.makeLeftSliderMove()},this),document.onmouseup=function(){document.onmousemove=document.onmouseup=null}),!1},t.prototype.makeRightSliderMove=function(t){var e=!1;t=!1!==t,this.rightSlider.style.right=this.rightPercent+"%",this.colorUnavailableActive.style.right=this.rightPercent+"%",this.leftPercent+this.rightPercent>=100&&(e=!0,this.leftPercent=100-this.rightPercent,this.leftSlider.style.left=this.leftPercent+"%",this.colorUnavailableActive.style.left=this.leftPercent+"%"),100-this.rightPercent>=this.fltMinPercent&&this.rightPercent>=this.fltMaxPercent?(this.colorAvailableActive.style.right=this.rightPercent+"%",e&&(this.colorAvailableActive.style.left=100-this.rightPercent+"%")):this.rightPercent<=this.fltMaxPercent?(this.colorAvailableActive.style.right=this.fltMaxPercent+"%",e&&(this.colorAvailableActive.style.left=100-this.fltMaxPercent+"%")):100-this.rightPercent<=this.fltMinPercent&&(this.colorAvailableActive.style.right=100-this.fltMinPercent+"%",e&&(this.colorAvailableActive.style.left=this.fltMinPercent+"%")),t&&(this.recountMaxPrice(),e&&this.recountMinPrice())},t.prototype.onMoveRightSlider=function(t){return this.isTouch||(this.rightSlider.ondragstart=function(){return!1}),this.isTouch?(document.ontouchmove=BX.proxy(function(t){this.rightPercent=100-100*this.countNewLeft(t)/this.trackerWrap.offsetWidth,this.makeRightSliderMove()},this),document.ontouchend=function(){document.ontouchmove=document.ontouchend=null}):(document.onmousemove=BX.proxy(function(t){this.rightPercent=100-100*this.countNewLeft(t)/this.trackerWrap.offsetWidth,this.makeRightSliderMove()},this),document.onmouseup=function(){document.onmousemove=document.onmouseup=null}),!1},t}();
/* End */
;
; /* Start:"a:4:{s:4:"full";s:108:"/bitrix/templates/universelite_s1/components/bitrix/catalog.section/catalog.tile.4/script.js?168451251511587";s:6:"source";s:92:"/bitrix/templates/universelite_s1/components/bitrix/catalog.section/catalog.tile.4/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
(function() {
    'use strict';

    if (!!window.JCCatalogSectionComponent)
        return;

    window.JCCatalogSectionComponent = function(params) {
        this.formPosting = false;
        this.siteId = params.siteId || '';
        this.ajaxId = params.ajaxId || '';
        this.template = params.template || '';
        this.componentPath = params.componentPath || '';
        this.parameters = params.parameters || '';
        this.columnCount = params.columnCount || '';
        this.giftShowed = params.giftShowed || '';

        if (params.navParams)
        {
            this.navParams = {
                NavNum: params.navParams.NavNum || 1,
                NavPageNomer: parseInt(params.navParams.NavPageNomer) || 1,
                NavPageCount: parseInt(params.navParams.NavPageCount) || 1
            };
        }

        this.bigData = params.bigData || {enabled: false};
        this.container = document.querySelector('[data-entity="' + params.container + '"]');
        this.showMoreButton = null;
        this.showMoreButtonMessage = null;

        if (this.bigData.enabled && BX.util.object_keys(this.bigData.rows).length > 0)
        {
            BX.cookie_prefix = this.bigData.js.cookiePrefix || '';
            BX.cookie_domain = this.bigData.js.cookieDomain || '';
            BX.current_server_time = this.bigData.js.serverTime;

            BX.ready(BX.delegate(this.bigDataLoad, this));
        }

        if (params.initiallyShowHeader)
        {
            BX.ready(BX.delegate(this.showHeader, this));
        }

        if (params.deferredLoad)
        {
            BX.ready(BX.delegate(this.deferredLoad, this));
        }

        if (params.lazyLoad)
        {
            this.showMoreButton = document.querySelector('[data-use="show-more-' + this.navParams.NavNum + '"]');
            this.showMoreButtonMessage = this.showMoreButton.innerHTML;
            BX.bind(this.showMoreButton, 'click', BX.proxy(this.showMore, this));
        }

        if (params.loadOnScroll)
        {
            BX.bind(window, 'scroll', BX.proxy(this.loadOnScroll, this));
        }
    };

    window.JCCatalogSectionComponent.prototype =
    {
        checkButton: function()
        {
            if (this.showMoreButton)
            {
                if (this.navParams.NavPageNomer == this.navParams.NavPageCount)
                {
                    BX.remove(this.showMoreButton);
                }
            }
        },

        enableButton: function()
        {
            if (this.showMoreButton)
            {
                BX.removeClass(this.showMoreButton, 'disabled');
                this.showMoreButton.innerHTML = this.showMoreButtonMessage;
            }
        },

        disableButton: function()
        {
            if (this.showMoreButton)
            {
                BX.addClass(this.showMoreButton, 'disabled');
                this.showMoreButton.innerHTML = BX.message('BTN_MESSAGE_LAZY_LOAD_WAITER');
            }
        },

        loadOnScroll: function()
        {
            var scrollTop = BX.GetWindowScrollPos().scrollTop,
                containerBottom = BX.pos(this.container).bottom;

            if (scrollTop + window.innerHeight > containerBottom)
            {
                this.showMore();
            }
        },

        showMore: function()
        {
            if (this.navParams.NavPageNomer < this.navParams.NavPageCount)
            {
                var data = {};
                data['action'] = 'showMore';
                data['PAGEN_' + this.navParams.NavNum] = this.navParams.NavPageNomer + 1;

                if (!this.formPosting)
                {
                    this.formPosting = true;
                    this.disableButton();
                    this.sendRequest(data);
                }
            }
        },

        bigDataLoad: function()
        {
            var url = 'https://analytics.bitrix.info/crecoms/v1_0/recoms.php',
                data = BX.ajax.prepareData(this.bigData.params);

            if (data)
            {
                url += (url.indexOf('?') !== -1 ? '&' : '?') + data;
            }

            var onReady = BX.delegate(function(result){
                this.sendRequest({
                    action: 'deferredLoad',
                    bigData: 'Y',
                    items: result && result.items || [],
                    rid: result && result.id,
                    count: this.bigData.count,
                    rowsRange: this.bigData.rowsRange,
                    shownIds: this.bigData.shownIds
                });
            }, this);

            BX.ajax({
                method: 'GET',
                dataType: 'json',
                url: url,
                timeout: 3,
                onsuccess: onReady,
                onfailure: onReady
            });
        },

        deferredLoad: function()
        {
            this.sendRequest({action: 'deferredLoad'});
        },

        sendRequest: function(data) {
            var defaultData = {
                siteId: this.siteId,
                template: this.template,
                parameters: this.parameters
            };
            if (this.ajaxId)
            {
                defaultData.AJAX_ID = this.ajaxId;
            }
            BX.ajax({
                url: this.componentPath + '/ajax.php' + (document.location.href.indexOf('clear_cache=Y') !== -1 ? '?clear_cache=Y' : ''),
                method: 'POST',
                dataType: 'json',
                timeout: 60,
                data: BX.merge(defaultData, data),
                onsuccess: BX.delegate(function(result){
                    if (!result || !result.JS)
                        return;

                    BX.ajax.processScripts(
                        BX.processHTML(result.JS).SCRIPT,
                        false,
                        BX.delegate(function(){this.showAction(result, data);}, this)
                    );
                }, this)
            });
        },

        showAction: function(result, data)
        {
            if (!data)
                return;

            switch (data.action)
            {
                case 'showMore':
                    this.processShowMoreAction(result);
                    break;
                case 'deferredLoad':
                    this.processDeferredLoadAction(result, data.bigData === 'Y');
                    break;
            }
        },

        processShowMoreAction: function(result)
        {
            this.formPosting = false;
            this.enableButton();

            if (result)
            {
                this.navParams.NavPageNomer++;
                this.processItems(result.items);
                this.processPagination(result.pagination);
                this.checkButton();
            }
        },

        processDeferredLoadAction: function(result, bigData)
        {
            if (!result)
                return;

            var position = bigData ? this.bigData.rows : {};

            this.processItems(result.items, BX.util.array_keys(position));
        },

        processItems: function(itemsHtml, position)
        {
            if (!itemsHtml)
                return;

            var processed = BX.processHTML(itemsHtml, false),
                temporaryNode = BX.create('DIV');

            var items, k, origRows;

            temporaryNode.innerHTML = processed.HTML;
            items = temporaryNode.querySelectorAll('[data-entity="items-row"]');

            if (items.length)
            {
                this.showHeader(true);

                for (k in items)
                {
                    if (items.hasOwnProperty(k))
                    {
                        origRows = position ? this.container.querySelectorAll('[data-entity="items-row"]') : false;
                        //items[k].style.opacity = 0;

                        if (origRows && BX.type.isDomNode(origRows[position[k]]))
                        {
                            origRows[position[k]].parentNode.insertBefore(items[k], origRows[position[k]]);
                        }
                        else
                        {
                            this.container.appendChild(items[k]);
                        }
                    }
                }

                /*new BX.easing({
                    duration: 2000,
                    start: {opacity: 0},
                    finish: {opacity: 100},
                    transition: BX.easing.makeEaseOut(BX.easing.transitions.quad),
                    step: function(state){
                        for (var k in items)
                        {
                            if (items.hasOwnProperty(k))
                            {
                                items[k].style.opacity = state.opacity / 100;
                            }
                        }
                    },
                    complete: function(){
                        for (var k in items)
                        {
                            if (items.hasOwnProperty(k))
                            {
                                items[k].removeAttribute('style');
                            }
                        }
                    }
                }).animate();*/
            }

            BX.ajax.processScripts(processed.SCRIPT);
        },

        processPagination: function(paginationHtml)
        {
            if (!paginationHtml)
                return;

            var pagination = document.querySelectorAll('[data-pagination-num="' + this.navParams.NavNum + '"]');
            for (var k in pagination)
            {
                if (pagination.hasOwnProperty(k))
                {
                    pagination[k].innerHTML = paginationHtml;
                }
            }
        },

        showHeader: function(animate)
        {
            var parentNode = BX.findParent(this.container, {attr: {'data-entity': 'parent-container'}}),
                header;

            if (parentNode && BX.type.isDomNode(parentNode))
            {
                header = parentNode.querySelector('[data-entity="header"');

                if (header && header.getAttribute('data-showed') != 'true')
                {
                    header.style.display = '';

                    if (animate)
                    {
                        new BX.easing({
                            duration: 2000,
                            start: {opacity: 0},
                            finish: {opacity: 100},
                            transition: BX.easing.makeEaseOut(BX.easing.transitions.quad),
                            step: function(state){
                                header.style.opacity = state.opacity / 100;
                            },
                            complete: function(){
                                header.removeAttribute('style');
                                header.setAttribute('data-showed', 'true');
                            }
                        }).animate();
                    }
                    else
                    {
                        header.style.opacity = 100;
                    }
                }
            }
        }
    };
})();
/* End */
;; /* /bitrix/templates/universelite_s1/components/bitrix/catalog.smart.filter/vertical.2/script.js?168451251424129*/
; /* /bitrix/templates/universelite_s1/components/bitrix/catalog.smart.filter/mobile.1/script.min.js?168451251412170*/
; /* /bitrix/templates/universelite_s1/components/bitrix/catalog.section/catalog.tile.4/script.js?168451251511587*/
