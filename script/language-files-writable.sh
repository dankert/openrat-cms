#!/bin/bash

for iso in de en es fr it ru cn; do

	touch ../language/lang-$iso.php
	chmod -v a+w ../language/lang-$iso.php
done