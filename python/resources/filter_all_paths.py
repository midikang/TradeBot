import sys
if len(sys.argv) > 1:
    print("Usage: python filter_all_paths.py < input (opt: redirect to resources/platform/unique_all_paths.txt)")
    exit()

def getUniqueBranches(allBranches):
    existingBranches = set()
    uniqueBranches = []
    for branchStr in allBranches:
        b = branchStr.strip().split("<>")[1:]
        #print(b)
        if "<>".join(b) in existingBranches:
            continue;

        uniqueBranches.append(branchStr.strip())
        for v in getVariationsOfBranch(b, len(b)):
            #print("\t\t"+str(v))
            existingBranches.add("<>".join(v))

    return uniqueBranches

def getVariationsOfBranch(branch,size):
    variations = []
    tmp = list(branch)
    tmp.extend(branch)
    for i in range(size):
        variations.append(tmp[i:size+i])

    return variations


a = sys.stdin.readlines()
#print(a)
uniqueBranches = getUniqueBranches(a)
print(str(len(uniqueBranches))+" unique paths")
print("\n".join(uniqueBranches))
