#!/bin/bash

for iso in de en es fr it ru cn; do

	touch ../modules/language/lang-$iso.php
	chmod -v a+w ../modules/language/lang-$iso.php
done
