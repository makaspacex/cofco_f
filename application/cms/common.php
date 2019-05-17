<?php

if (!function_exists('attr_url')) {
	/**
	 * 生成属性链接
	 * @date   2019-01-12
	 * @access public
	 * @author 橘子俊 364666827@qq.com
	 * @param  [type]     $key   参数名
	 * @param  [type]     $val   参数值
	 * @param  string     $text  显示文本
	 * @param  string     $active 选中样式
	 * @return string
	 */
	function attr_url($key, $val, $text = '', $active = 'active') {

		$key 	= 'attr'.$key;
		$param 	= input('param.');

		if (isset($param['page'])) {
			unset($param['page']);
		}

		if (isset($param[$key]) && $param[$key] == $val) {

			$url = '?'.http_build_query($param);

			if (!$text) return $url;

			return '<a href="'.$url.'" class="'.$active.'">'.$text.'</a>';

		} else {

			if ($val) {

				if ($val == 'all') {
					unset($param[$key]);
				} else {
					$param[$key] = $val;
				}

			} elseif (isset($param[$key])) {

				unset($param[$key]);

			}


			$url = '?'.http_build_query($param);

			if (!$text) return $url;

			return '<a href="'.$url.'">'.$text.'</a>';

		}

	}
}
