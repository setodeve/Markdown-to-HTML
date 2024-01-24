import sys
import markdown
import json
def main(data):
    config = {
        "codehilite":{
            "noclasses": True,
        }
    }
    decodeData = json.loads(data[1])
    print(markdown.markdown(decodeData["textData"],
                            extensions=["extra", "codehilite", "sane_lists", "toc", "fenced_code"], extension_configs=config))
if __name__ == "__main__":
    main(sys.argv)