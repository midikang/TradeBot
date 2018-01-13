#!/bin/bash
	# check if unique_paths file exists
if [ ! -e $2"/unique_paths.txt" ];
then 
	# check if all_paths exists
	if ! test -e $2"/all_paths.txt";
	then
		`python ../gen_resources.py $2 > $2"/all_paths.txt"`;
	fi
	# regen if nec
	`cat $2"/all_paths.txt" | grep "steps<>" | python filter_all_paths.py > $2/"unique_paths.txt"`;
fi

i=1
while test $i -le $1
do
	`python get_branch_of_steps.py $i < $2"/unique_paths.txt" > $2/$i"steps.txt"`;
	i=$[$i+1]
done
