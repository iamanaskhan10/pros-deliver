import Anthropic from "@anthropic-ai/sdk";

const client = new Anthropic({
  apiKey: "YOUR_API_KEY",
});

async function test() {
  try {
    const response = await client.messages.create({
      model: "claude-opus-4-7",
      max_tokens: 100,
      messages: [
        { role: "user", content: "Say hello briefly" }
      ],
    });

    console.log("✅ Success:");
    console.log(response.content[0].text);
  } catch (err) {
    console.error("❌ Error:");
    console.error(err);
  }
}

test();