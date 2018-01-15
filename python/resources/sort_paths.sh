#!/bin/bash
if ! [ $# -eq 2 -o $# -eq 3 ]
then
	echo "Usage: ./sort_paths.sh maxSteps platform (opt: redo)";

else
	if [ $# -eq 3 ]
	then
		if [ $3 = 'redo' ]
		then
			pdir="1pXs/"$2;
			`python ../gen_single_plat_paths.py $2 > $pdir"/all_paths.txt"`;
			`cat $pdir"/all_paths.txt" | grep "steps<>" | python filter_all_paths.py > $pdir/"unique_paths.txt"`;
		fi
	else
		# check if unique_paths file exists
		pdir="1pXs/"$2;
		if ! test -e $pdir"/unique_paths.txt";
		then
			# check if all_paths exists
			if ! test -e $pdir"/all_paths.txt";
			then
				`python ../gen_single_plat_paths.py $2 > $pdir"/all_paths.txt"`;
			fi
			# regen if nec
			`cat $pdir"/all_paths.txt" | grep "steps<>" | python filter_all_paths.py > $pdir/"unique_paths.txt"`;
		fi
	fi

	i=1
	while test $i -le $1
	do
		`python get_branch_of_steps.py $i < $pdir"/unique_paths.txt" > $pdir/$i"steps.txt"`;
		i=$[$i+1]
	done
fi
