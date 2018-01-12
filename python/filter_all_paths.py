from helper_func import eprint
import sys
if len(sys.argv) > 1:
    eprint("Usage: python filter_all_paths.py < input (opt: redirect to resources/platform/unique_all_paths.txt)")
    exit()

from tree_func import getUniqueBranches, getVariationsOfBranch
a = sys.stdin.readlines()
#print(a)
uniqueBranches = getUniqueBranches(a)
print(len(uniqueBranches))
print("\n".join(uniqueBranches))
